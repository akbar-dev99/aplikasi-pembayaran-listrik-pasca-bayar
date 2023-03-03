<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Class Login
 *
 * @description Controller untuk halaman login user / admin
 *
 * @package     Admin Controller
 * @subpackage  Login
 * @category    Controller
 */
class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
  }


  public function index()
  {

    $data["title"] = "Masuk";
    $this->load->view('layouts/auth/head', $data);
    $this->load->view('admin/v_login', $data);
    $this->load->view('layouts/auth/end', $data);
    // $this->load->view("overview");
  }

  public function create()
  {
    $this->form_validation->set_rules('id_user', 'ID User', 'required|callback_id_check');
    $this->form_validation->set_rules('password', 'Password', 'required');


    $form_values = array(
      'id_user' => $this->input->post('id_user'),
      'password' => $this->input->post('password'),
    );

    if ($this->form_validation->run() === FALSE) {
      $this->set_form_values($form_values);
      $this->index();
    } else {
      $id_user = $this->input->post('id_user');
      $password = $this->input->post('password');
      $user = $this->M_user->get_user_by_id($id_user);
      if ($user) {
        // Membuat array session untuk menyimpan data user
        $session = array(
          'id_user' => $user->id_user,
          'username' => $user->username,
          'nama' => $user->nama_admin,
          'role' => strtoupper($user->id_level),
          'logged_in' => TRUE
        );

        // Pengecekan untuk login menggunakan ID superadmin
        if ($user->id_user == "ADM0000") {
          if ($user->password == $password) {
            // Set session untuk superadmin
            $data = ["user" => $session];
            $this->session->set_userdata($session);
            // Tampilkan pesan sukses
            $this->session->set_flashdata('message_success', 'Selamat datang ' . $user->username . '!');
            // Redirect ke halaman administrator/masuk
            $this->session->set_flashdata('message_welcome', TRUE);

            redirect('administrator');
          } else {
            // Tampilkan pesan error dan form values
            $form_values["password"] = "";
            $this->set_form_values($form_values);

            $this->session->set_flashdata('message_error', 'Password yang Anda masukkan salah');
            // Redirect ke halaman administrator/masuk

            redirect('administrator/masuk');
          }
        } else {
          // Pengecekan password untuk user selain superadmin
          // Cek password dengan menggunakan password_verify
          if (password_verify($password, $user->password)) {
            // Set session untuk user dan pessan welcome
            $this->session->set_userdata($session);
            $this->session->set_flashdata('message_welcome', TRUE);
            // Redirect ke halaman administrator
            redirect('administrator');
          } else {
            // jika password salah, Set nilai form kembali dan set pesan error kemudian redirect!
            $form_values["password"] = "";
            $this->set_form_values($form_values);
            $this->session->set_flashdata('message_error', 'Password yang Anda masukkan salah');
            redirect('administrator/masuk');
          }
        }
      } else {
        // jika ID user tidak ditemukan, Set nilai form kembali dan set pesan error kemudian redirect!
        $this->set_form_values($form_values);
        $this->session->set_flashdata('message_error', 'ID tidak ditemukan');
        redirect('administrator/masuk');
      }
    }
  }

  // Ini adalah fungsi untuk memvalidasi id_user. Fungsi ini akan dipanggil oleh form_validation sebagai callback

  public function id_check($id)
  {
    // Fungsi akan memanggil method M_user->get_user() dengan parameter "id_user" yang sama dengan $id yang diterima sebagai input.
    $user =  $this->M_user->get_user(["id_user" => $id]);

    /*
      Jika tidak ada user dengan id_user yang sama, maka akan mengatur pesan error dengan menggunakan set_message() dan mengembalikan nilai FALSE.
      Jika user ditemukan, maka akan mengembalikan nilai TRUE.
    */
    if (!$user) {
      $this->form_validation->set_message('id_check', '{field} tidak ditemukan ');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  // function untuk simpan inputan kedalam session jika terjadi redirect ke halaman login/masuk
  public function set_form_values($data)
  {
    $this->session->set_flashdata('form_values', $data);
  }


  public function logout()
  {
    $this->session->sess_destroy();
    redirect('administrator/masuk');
  }
}
