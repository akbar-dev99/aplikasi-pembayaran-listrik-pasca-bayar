<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Customer
 *
 * @description Controller untuk halaman dan mengatur fitur pelanggan
 *
 * @package     Admin Controller
 * @subpackage  Customer
 * @category    Controller
 */
class Customer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }


  public function index()
  {
    $data['user_auth'] = get_logged_in_user();
    $data["title"] = "Pelanggan";
    // memulai benchmark
    // $this->benchmark->mark('code_start');
    // method atau fungsi yang akan diukur kinerjanya, yaitu berupa
    $data['customers'] = $this->M_customer->get_customers();
    // mengakhiri benchmark
    // $this->benchmark->mark('code_end');
    // $elapsed_time = $this->benchmark->elapsed_time('code_start', 'code_end');
    // menampilkan waktu eksekusi dan memory yang digunakan
    // echo json_encode(BenchmarkInfo($elapsed_time, "Query mengambil data pelanggan"));
    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/csmr/v_csmr', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function create()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_space|is_unique[pelanggan.username]');
    $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required');
    $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('id_tarif', 'ID Tarif', 'required');


    //  dapatkan ID pelanggan dengan menggunakan fungsi GetAutoNumber
    $csmr_id  = GetAutoNumber("pelanggan", "id_pelanggan", "PLG" . date("ymd"), 13);
    $data_post = array(
      "id_pelanggan" => $csmr_id,
      'username' => $this->input->post('username'),
      // Hash password menggunakan password_hash tetapi menggunaka default password yaitu "PLGN123" dan algoritma BCRYPT
      'password' => password_hash('PLGN123', PASSWORD_BCRYPT),
      'nomor_kwh' => $this->input->post('nomor_kwh'),
      'nama_pelanggan' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'id_tarif' => $this->input->post('id_tarif'),
    );
    // Jika form validation gagal, tampilkan form tambah pelanggan
    // dengan mengirimkan data error dan data isian yang sebelumnya dikirim
    if ($this->form_validation->run() === FALSE) {
      $data['user_auth'] = get_logged_in_user();
      $data["title"] = "Input Data Pelanggan";
      $data['tariffs'] = $this->M_tariff->get_tariffs();
      $validation_err = $data_post;
      $this->session->set_flashdata('validation_err', $validation_err);

      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar_admin', $data);
      $this->load->view('layouts/header_admin', $data);
      $this->load->view('admin/csmr/v_csmr_create', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {

      // Simpan data pelanggan baru ke database menggunakan M_customer->insert_customer dari model customer
      $result = $this->M_customer->insert_customer($data_post);

      // Jika berhasil, beri pesan sukses dan redirect ke halaman data pelanggan
      if ($result) {
        $this->session->set_flashdata('message_success', 'Berhasil menambahkan data pelanggan baru!');
        redirect(base_url('administrator/pelanggan'));
      } else {
        // Jika gagal, tampilkan pesan error dan redirect ke halaman form tambah pelangan
        $this->session->set_flashdata('message_error', 'Gagal menambahkan data pelanggan!');
        redirect(base_url('administrator/pelanggan/tambah'));
      }
    }
  }

  public function update($id)
  {
    $data['user_auth'] = get_logged_in_user();
    $customer = $this->M_customer->get_customer_by_id($id);
    $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_space');
    $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required');
    $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('id_tarif', 'Tarif', 'required');

    $data_post = [
      'username' => $this->input->post('username'),
      'nomor_kwh' => $this->input->post('nomor_kwh'),
      'nama_pelanggan' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'id_tarif' => $this->input->post('id_tarif'),
    ];


    if (!$customer) {
      $this->session->set_flashdata('message_warning', 'Seperti terjadi kesalahan saat mengakses detail data pelanggan! silahkan coba lagi');
      redirect(base_url('administrator/pelanggan'));
    }

    $data['customer'] = $customer;
    if ($this->form_validation->run() === FALSE) {
      $data["title"] = "Ubah Data Pelanggan";

      $data['tariffs'] = $this->M_tariff->get_tariffs();
      $validation_err = $data_post;
      $this->session->set_flashdata('validation_err', $validation_err);

      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar_admin', $data);
      $this->load->view('layouts/header_admin', $data);
      $this->load->view('admin/csmr/v_csmr_edit', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {
      if ($data_post["username"] != $customer->username) {
        $exist_username = $this->M_customer->get_customer_by_username($this->input->post('username'));
        if ($exist_username) {
          $this->session->set_flashdata('message_error', 'Gagal mengubah data pelanggan, di karena username yang di input telah di pakai ');
          redirect(base_url('administrator/pelanggan/ubah/' . $customer->id_pelanggan));
        }
      }


      if ($this->input->post("reset_pw") === 'TRUE') {
        $data_post["password"] = password_hash('PLGN123', PASSWORD_BCRYPT);
        $this->session->set_flashdata('message_warning', 'Kata sandi untuk pelanggan <strong>' .  $customer->id_pelanggan . '</strong> telah di reset ke default. <br> Kata sandi default : <strong>PLGN123</strong>');
      }

      $result = $this->M_customer->update_customer($customer->id_pelanggan, $data_post);
      $this->session->set_flashdata('message_success', 'Berhasil mengubah data pelanggan <strong>' .  $customer->id_pelanggan . '</strong>!');

      redirect(base_url('administrator/pelanggan'));
    }
  }

  public function delete($id)
  {
    $this->M_customer->delete_customer($id);
    $this->session->set_flashdata('message_success', 'Berhasil menghapus pelanggan dengan ID <strong>' . $id . '</strong>');
    redirect(base_url('administrator/pelanggan'));
  }

  public function check_space($str)
  {
    if (preg_match('/\s/', $str)) {
      $this->form_validation->set_message('check_space', 'The %s field must not contain spaces or whitespaces');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
