<?php

/**
 * Class ProfileAdmin
 *
 * @description Controller untuk halaman dan mengatur fitur profile administrasi
 *
 * @package     Admin Controller
 * @subpackage  ProfileAdmin
 * @category    Controller
 */
class ProfileAdmin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }


  public function index()
  {
    $user =  get_logged_in_user();
    $data['user_auth'] = $user;
    $data['title'] = "Profil";
    // $data["title"] = "Data Petugas";
    $data["user_pays"] = $this->M_payment->get_pembayaran_by_id_user($user->id_user);
    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/v_profile', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function update()
  {
    $user =  get_logged_in_user();
    // Ambil data dari form
    $id_user = $user->id_user;
    $nama_admin = $this->input->post('nama_admin');
    $username = $this->input->post('username');

    // Buat data array untuk update
    $data = array(
      'nama_admin' => $nama_admin,
      'username' => $username,
    );

    $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_space');
    $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message_error', 'Pastikan Nama atau username ada tidak boleh kosong');
      redirect('administrator/profile');
    } else {
      // Panggil function update_profile pada model user
      $this->M_user->update_user($id_user, $data);

      // Menapilkan pesan berhasil dan redirect ke halaman profil setelah update
      $this->session->set_flashdata('message_success', 'Berhasil mengubah profil');
      redirect('administrator/profile');
    }
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
