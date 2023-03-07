<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Class Payment
 *
 * @description Controller untuk halaman pembayaran
 *
 * @package     Admin Controller
 * @subpackage  Payment
 * @category    Controller
 */
class Payment extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }


  public function index()
  {
    $data["title"] = "Data Pembayaran";
    $data['pays'] =  $this->M_payment->get_all_pembayaran();
    $data['user_auth'] = get_logged_in_user();

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/payment/v_pay', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }


  public function create($id)
  {
    $bill = $this->M_bill->get_tagihan_by_id($id);

    $data["title"] = "Konfirmasi Pembayaran : -";
    $data['user_auth'] = get_logged_in_user();
    $admin_fee = AdminFee();
    $redirect_back = 'administrator/tagihan/' . $id . '/bayar';
    $error_notfound = TRUE;
    if ($bill) {
      $error_notfound = FALSE;
      $data["title"] = "Konfirmasi Pembayaran : " . $bill->id_tagihan;
      $total_bill = $bill->tarif_perkwh * $bill->jumlah_meter;
      $total_pay = $total_bill + $admin_fee;
      $data["total_bill"] = Rupiah($total_bill);
      $data["admin_fee"] = Rupiah($admin_fee);
      $data["total_pay"] = Rupiah($total_pay);
      $data["total_pay_num"] = $total_pay;

      // Validasi apakah tagihan yang ingin dibayar telah lunas atau belum, jika telah lunas maka pembayaran di batalkan karena telah lunas
      if ($bill->status === 'PAID') {
        $this->session->set_flashdata('message_error', 'Tagihan ' . $id . '</strong>. telah lunas');
        redirect('administrator/tagihan/' . $id);
      }

      if ($bill->status === 'PROCESSED') {
        $this->session->set_flashdata('message_info', 'Tagihan ' . $id . '</strong>. sedang menunggu konfirmasi pembayaran');
        redirect('administrator/tagihan/' . $id);
      }
    }

    $current_month = date("m");
    $current_year = date("Y");
    $bill_month = $bill->bulan;
    $bill_year = $bill->tahun;


    $pay_blocked = $current_year > $bill_year || ($current_year == $bill_year && $current_month > $bill_month);

    if ($pay_blocked === false) {
      $this->session->set_flashdata('message_error', 'Pembayaran untuk tagihan <strong>' . $id . '</strong> dapat di lakukan bulan depan!');
      redirect('administrator/tagihan/' . $id);
    }

    $data["error"] = $error_notfound;
    $data["bill"] = $bill;
    $data["req_id"] = $id;
    $data["curr_date"] = date("Y-m-d");
    $id_user = $this->session->userdata('id_user');

    $this->form_validation->set_rules('tanggal_bayar', 'Tanggal Bayar', 'required');
    $this->form_validation->set_rules('total_bayar', 'Jumlah Bayar', 'trim|required');

    $form_values = [
      "total_bayar" => $this->input->post('total_bayar', true),
      'tanggal_bayar' => $this->input->post('tanggal_bayar', true),
    ];


    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('form_values', $form_values);
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar_admin', $data);
      $this->load->view('layouts/header_admin', $data);
      $this->load->view('admin/payment/v_pay_create', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {

      $total_bill = $bill->tarif_perkwh * $bill->jumlah_meter;
      $total_pay = $total_bill + $admin_fee;

      if ($this->input->post('total_bayar') < $total_pay) {
        $this->session->set_flashdata('message_error', 'Jumlah pembayaran kurang dari total pembayaran!');
        redirect($redirect_back);
      }

      if ($this->input->post('total_bayar') > $total_pay) {
        $this->session->set_flashdata('message_error', 'Jumlah pembayaran lebih dari pembayaran!');
        redirect($redirect_back);
      }

      //Memulai transaksi
      $this->db->trans_start();
      // proses data pembayaran
      $data_pay = [
        'id_pembayaran' => GetAutoNumber("pembayaran", "id_pembayaran", "PAY" . date("ymd"), 12),
        'id_pelanggan' => $bill->id_pelanggan,
        'id_tagihan' => $bill->id_tagihan,
        'total_bayar' => $form_values['total_bayar'],
        'id_user' => $id_user,
        'tgl_bayar' => $form_values["tanggal_bayar"],
        "biaya_admin" => $admin_fee,
      ];
      // insert data pembayaran
      $this->M_payment->insert_pembayaran($data_pay);
      // update data status tagihan
      $this->M_bill->update_tagihan_status_by_id($bill->id_tagihan, "PAID");
      //Menyelesaikan transaksi
      $this->db->trans_complete();
      //Mengecek apakah transaksi berhasil atau gagal
      if ($this->db->trans_status() === FALSE) {
        //Jika transaksi gagal, melakukan rollback
        $this->session->set_flashdata('message_error', 'Pembayaran Gagal');
        redirect('administrator/pembayaran');
      } else {
        //Jika transaksi berhasil, melakukan commit
        $this->session->set_flashdata('message_success', 'Pembayaran berhasil disimpan');
        redirect('administrator/pembayaran');
      }
    }
  }


  public function confirm()
  {

    $this->form_validation->set_rules('id_tagihan', 'ID Tagihan', 'required');

    $bill_id = $this->input->post("id_tagihan");
    $user_id = $this->session->userdata('id_user');

    $redirect_back = 'administrator/tagihan/' . $bill_id;

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message_error', 'Konfirmasi pembayaran gagal, tidak dapat menemukan ID tagihan');
      redirect($redirect_back);
    } else {
      $exist_payment = $this->M_payment->get_pembayaran_by_id_tagihan($bill_id);
      if (empty($exist_payment)) {
        // $this->session->set_flashdata('message_info', 'Tagihan ' . $id . '</strong>.');
        $this->session->set_flashdata('message_error', 'Konfirmasi pembayaran gagal, pastikan apakah tagihan <strong>' . $bill_id . '</strong> telah melakukan pembayaran atau belum');
        redirect($redirect_back);
      }


      $this->db->trans_start();
      // proses data pembayaran untuk diupdate
      $data_pay = [
        'id_user' => $user_id,
      ];
      // update data pembayaran
      $this->M_payment->update_pembayaran(["id_pembayaran" => $exist_payment->id_pembayaran], $data_pay);
      // update data status tagihan
      $this->M_bill->update_tagihan_status_by_id($exist_payment->id_tagihan, "PAID");
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        //Jika transaksi gagal, melakukan rollback
        $this->session->set_flashdata('message_error', 'Konfirmasi Pembayaran Gagal');
        redirect($redirect_back);
      } else {
        //Jika transaksi berhasil, melakukan commit
        $this->session->set_flashdata('message_success', 'Konfirmasi pembayaran berhasil');
        redirect($redirect_back);
      }
    }
  }

  public function reject()
  {

    $this->form_validation->set_rules('id_tagihan', 'ID Tagihan', 'required');

    $bill_id = $this->input->post("id_tagihan");

    $redirect_back = 'administrator/tagihan/' . $bill_id;

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message_error', 'Penolakan pembayaran gagal, tidak dapat menemukan ID tagihan');
      redirect($redirect_back);
    } else {
      $exist_payment = $this->M_payment->get_pembayaran_by_id_tagihan($bill_id);
      if (empty($exist_payment)) {
        // $this->session->set_flashdata('message_info', 'Tagihan ' . $id . '</strong>.');
        $this->session->set_flashdata('message_error', 'Penolakan pembayaran gagal, pastikan apakah tagihan <strong>' . $bill_id . '</strong> telah melakukan pembayaran atau belum');
        redirect($redirect_back);
      }


      $this->db->trans_start();
      // insert data pembayaran
      $this->M_payment->delete_pembayaran($exist_payment->id_pembayaran);
      // update data status tagihan
      $this->M_bill->update_tagihan_status_by_id($bill_id, "UNPAID");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        //Jika transaksi gagal, melakukan rollback
        $this->session->set_flashdata('message_error', 'Penolakan Pembayaran Gagal');
        redirect($redirect_back);
      } else {
        //Jika transaksi berhasil, melakukan commit
        $this->session->set_flashdata('message_warning', 'Penolakan pembayaran berhasil');
        redirect($redirect_back);
      }
    }
  }
}
