<?php

/**
 * Class Penggunaan
 *
 * @description Controller untuk halaman dan mengatur fitur penggunaan listrik
 *
 * @package     Admin Controller
 * @subpackage  Penggunaan
 * @category    Controller
 */
class Usage extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }

  public function index()
  {
    $data["title"] = "Data Penggunaan";
    $data['user_auth'] = get_logged_in_user();
    $data['usages'] = $this->M_usage->get_all_penggunaan();

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/usage/v_usage', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function delete($id)
  {
    // Cek data penggunaan apakah $id yang direquest sesuai dangan id_pelanggan;
    $check = $this->M_usage->get_penggunaan_by_id($id);

    if ($check) {
      $id_usage = $check->id_penggunaan;
      $id_customer = $check->id_pelanggan;
      $usage_month = $check->bulan;
      $usage_year = $check->tahun;
      // Ambil data tagihan dari tabel tagihan
      $check_bill = $this->M_bill->get_data_tagihan_by_period($id_usage, $id_customer, $usage_month, $usage_year);

      // cek apakah tagihan ada, jika ya hapus penggunaan bersama data tagihannya
      if ($check_bill) {

        // Cek apakah tagihan sudah lunas!
        if ($check_bill->status === "PAID") {
          // Jika ya batalkan dan menampilkan pesan error
          $this->session->set_flashdata('message_error', 'Tidak bisa menghapus data penggunaan yang dimaksud karena tagihannya sudah lunas');
          redirect(base_url('administrator/penggunaan'));
        } else {
          // Jika tidak hapus penggunaan dan tagihannya
          $this->M_usage->delete_penggunaan($id_usage);
          $this->M_bill->delete_tagihan_by_usage_and_period($id_usage, $id_customer, $usage_month, $usage_year);

          $this->session->set_flashdata('message_success', 'Berhasil menghapus data pengunaan!!');
          redirect(base_url('administrator/penggunaan'));
        }
      } else {
        $this->M_usage->delete_penggunaan($id);
        $this->session->set_flashdata('message_success', 'Berhasil menghapus data pengunaan!!');
        redirect(base_url('administrator/penggunaan'));
      }
    } else {
      $this->session->set_flashdata('message_error', 'Gagal menghapus penggunaan karena ID penggunaan yang di dikirim tidak tersedia!');
      redirect(base_url('administrator/penggunaan'));
    }
  }
}
