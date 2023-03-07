<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Login Customer
 *
 * @description Controller untuk halaman login pelanggan
 *
 * @package     Customer Controller
 * @subpackage  Login Customer
 * @category    Controller
 */
class Login extends CI_Controller
{
  /**
   * @description Login constructor.
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * @description Menampilkan halaman login pelanggan
   */
  public function index()
  {
    $data["title"] = "Masuk";
    $this->load->view('layouts/auth/head', $data);
    $this->load->view('v_login', $data);
    $this->load->view('layouts/auth/end', $data);
    // $this->load->view("overview");
  }


  /**
   * @description Menyimpan data login dan melakukan validasi
   */
  public function create()
  {
    // Menetapkan aturan validasi untuk form
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]|alpha_dash');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|alpha_numeric');

    // Mengambil data dari form
    $username = $this->input->post('username', TRUE); // filter input dengan fungsi xss_clean
    $password = $this->input->post('password', TRUE); // filter input dengan fungsi xss_clean

    // Menambahkan pesan error yang jelas ketika validasi gagal atau terjadi kesalahan login, dan menampilkan pesan tersebut pada halaman login.
    $this->form_validation->set_message('required', '{field} harus diisi');
    $this->form_validation->set_message('min_length', '{field} minimal {param} karakter');
    $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter');
    $this->form_validation->set_message('alpha_dash', '{field} hanya boleh berisi huruf, angka, underscore, atau dash');
    $this->form_validation->set_message('alpha_numeric', '{field} hanya boleh berisi huruf atau angka');

    // Mendefinisikan data untuk diteruskan pada saat ada error validasi
    $validation_err = array(
      'username' => $username,
      'password' => $password,
    );

    // Mengecek apakah form validasi sudah benar & menampilkan halaman login
    if ($this->form_validation->run() == FALSE) {
      // Menyimpan data error validasi pada session
      $this->session->set_flashdata('validation_err', $validation_err);

      // Menampilkan halaman login
      $data["title"] = "Masuk";
      $this->load->view('layouts/auth/head', $data);
      $this->load->view('v_login', $data);
      $this->load->view('layouts/auth/end', $data);
    } else {
      // Mencari data customer berdasarkan username
      $customer = $this->M_customer->get_customer_by_username($username);
      // Mengecek apakah customer tersebut ada
      if ($customer) {
        // Mengecek apakah password yang diinput sesuai dengan password pelanggan
        if (password_verify($password, $customer->password)) {
          // Menyimpan data pelanggan pada session
          $session = [
            'id_pelanggan' => $customer->id_pelanggan,
            'nama' => $customer->nama_pelanggan,
            'username' => $customer->username,
            'logged_in' => TRUE,
            "role" => "CUSTOMER",
          ];

          $this->session->set_userdata($session);
          $this->session->set_flashdata('message_welcome', TRUE);
          // Redirect ke halaman pelanggan
          redirect('pelanggan');
        } else {
          // Menyimpan data error dan pessan error pada session
          $this->session->set_flashdata('validation_err', $validation_err);
          $this->session->set_flashdata('message_error', 'Kata sandi yang anda masukan salah!');

          // Redirect ke halaman login
          redirect('pelanggan/masuk');
        }
      } else {
        // Menyimpan data error dan pessan error pada session
        $this->session->set_flashdata('validation_err', $validation_err);
        $this->session->set_flashdata('message_error', 'Kata sandi yang anda masukan salah!');
        // Redirect ke halaman login
        redirect('pelanggan/masuk');
      }
    }
  }

  /**
   * @description Melakukan logout dan menghapus session pelanggan
   */
  public function logout()
  {
    $this->session->set_flashdata('message_success', 'Logout berhasil, sampai jumpa lagi!');
    $this->session->sess_destroy();
    redirect('pelanggan/masuk');
  }
}
