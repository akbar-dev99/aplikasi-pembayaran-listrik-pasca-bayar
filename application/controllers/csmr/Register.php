<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Class Register
 *
 * Class ini digunakan untuk mengatur fitur pendaftaran pelanggan baru
 *
 * @package     Customer Controller
 * @subpackage  Register
 * @category    Controller
 */
class Register extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_customer');
  }

  public function index()
  {
    $data["title"] = "Daftar";
    $data['tariffs'] = $this->M_tariff->get_tariffs();
    $this->load->view('layouts/auth/head', $data);
    $this->load->view('v_register', $data);
    $this->load->view('layouts/auth/end', $data);
    // $this->load->view("overview");
  }

  public function create()
  {

    // Menetapkan aturan validasi untuk inputan
    $this->form_validation->set_rules('nama', 'Nama', 'required', [
      'required' => 'Nama harus di isi! ',
    ]);
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pelanggan.username]', [
      'required' => 'Username harus di isi!',
      'is_unique' => "Username telah ada!",
      'min_length' => ' Kata sandi terlalu pendek ! '
    ]);
    $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim|min_length[3]|matches[password2]', [
      'required' => 'Masukan kata sandi anda! ',
      'matches' => ' Kata sandi tidak sama !',
      'min_length' => ' Kata sandi terlalu pendek ! '
    ]);
    $this->form_validation->set_rules('password2', 'Ulang Kata Sandi', 'required|trim|min_length[3]|matches[password]', [
      'required' => 'Konfirmasi ulang kata sandi anda! ',
      'matches' => ' Kata sandi tidak sama !',
    ]);
    $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|integer', [
      'required' => 'Masukan nomor kwh!',
      'integer' => "Nomor KWH harus berisi angka saja"
    ]);
    $this->form_validation->set_rules('alamat', 'alamat', 'required', [
      'required' => 'Alamat harus diisi! ',
    ]);
    $this->form_validation->set_rules('id_tarif', 'id_tarif', 'required', [
      'required' => 'Pilih tarif anda! ',
    ]);

    // Jika form validation gagal, tampilkan form register
    // dengan mengirimkan data error dan data isian yang sebelumnya dikirim
    if ($this->form_validation->run() === FALSE) {
      $data["title"] = "Daftar";
      $data['tariffs'] = $this->M_tariff->get_tariffs();
      $validation_err = array(
        'nama' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'nomor_kwh' => $this->input->post('nomor_kwh'), // menambahkan nomor kwh
        'alamat' => $this->input->post('alamat'),
        'id_tarif' => $this->input->post('id_tarif'),
      );
      $this->session->set_flashdata('validation_err', $validation_err);
      $this->load->view('layouts/auth/head', $data);
      $this->load->view('v_register', $data);
      $this->load->view('layouts/auth/end', $data);
    } else {
      // Jika form validation berhasil, dapatkan ID pelanggan
      // dengan menggunakan fungsi GetAutoNumber
      $csmr_id  = GetAutoNumber("pelanggan", "id_pelanggan", "PLG" . date("ymd"), 13);
      $data = array(
        "id_pelanggan" => $csmr_id,
        'nama_pelanggan' => $this->input->post('nama'),
        'username' => strtolower($this->input->post('username')),
        // Hash password menggunakan password_hash dan algoritma BCRYPT
        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        'nomor_kwh' => $this->input->post('nomor_kwh'),
        'alamat' => $this->input->post('alamat'),
        'id_tarif' => $this->input->post('id_tarif'),
      );
      // Simpan data pelanggan baru ke database menggunakan M_customer->insert_customer dari model customer
      $result = $this->M_customer->insert_customer($data);

      // Jika berhasil, tampilkan pesan sukses dan redirect ke halaman masuk
      if ($result) {
        $this->session->set_flashdata('message_success', 'Pendaftaran berhasil, silahkan masuk!');
        redirect(base_url('pelanggan/masuk'));
      } else {
        // Jika gagal, tampilkan pesan error dan redirect ke halaman daftar
        $this->session->set_flashdata('message_error', 'Pendaftaran gagal, silahkan coba lagi !');
        redirect(base_url('pelanggan/daftar'));
      }
    }
  }
}
