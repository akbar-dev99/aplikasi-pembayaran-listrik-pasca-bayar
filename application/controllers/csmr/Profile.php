<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class ProfileCustomer
 *
 * @description Controller untuk halaman dan mengatur fitur profile pelanggan
 *
 * @package     Customer Controller
 * @subpackage  ProfileCustomer
 * @category    Controller
 */
class Profile extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_customer_login();
  }

  public function index()
  {
    $user_auth = get_logged_in_customer();
    $data["title"] = "Profil";
    $data['user_auth'] = $user_auth;
    $profile = $this->M_customer->get_customer_by_id($user_auth->id_pelanggan);
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


    $data['customer'] = $profile;
    if ($this->form_validation->run() === FALSE) {

      $data['tariffs'] = $this->M_tariff->get_tariffs();
      $data["profile"] = $profile;
      $form_values = $data_post;
      $this->session->set_flashdata('form_values', $form_values);
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('layouts/header', $data);
      $this->load->view('v_cs_profile', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {
      if ($data_post["username"] != $profile->username) {
        $exist_username = $this->M_customer->get_customer_by_username($this->input->post('username'));
        if ($exist_username) {
          $this->session->set_flashdata('message_error', 'Gagal mengubah data pelanggan, di karena username yang di input telah di pakai ');
          redirect(base_url('pelanggan/profile'));
        }
      }

      $result = $this->M_customer->update_customer($profile->id_pelanggan, $data_post);
      $this->session->set_flashdata('message_success', 'Berhasil mengubah profile!');
      redirect(base_url('pelanggan/profile'));
    }
  }


  public function change_password()
  {
    $user_auth = get_logged_in_customer();
    $data["title"] = "Ubah Password";
    $data['user_auth'] = $user_auth;
    $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
    $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[5]');
    $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password_baru]');

    if ($this->form_validation->run() == false) {
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('layouts/header', $data);
      $this->load->view('v_cs_editpw', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {
      $old_password = $this->input->post('password_lama');
      $new_password = $this->input->post('password_baru');
      $id_pelanggan = $user_auth->id_pelanggan;

      $user = $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array();

      if (password_verify($old_password, $user['password'])) {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('pelanggan');

        $this->session->set_flashdata('message_success', 'Password berhasil diubah!');
        redirect('pelanggan/profile');
      } else {
        $this->session->set_flashdata('message_error', 'Password lama salah!');
        redirect('pelanggan/profile/ubah-password');
      }
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
