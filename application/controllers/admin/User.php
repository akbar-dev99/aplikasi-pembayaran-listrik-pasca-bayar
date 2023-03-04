<?php


/**
 * Class User
 *
 * @description Controller untuk halaman dan mengatur fitur user
 *
 * @package     Admin Controller
 * @subpackage  User
 * @category    Controller
 */
class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_user_login();
    is_only_admin();
  }

  public function index()
  {
    // Load model and join with level table
    $data['users'] = $this->M_user->get_all_user();
    $data['user_auth'] = get_logged_in_user();
    $data['logged_in_user_id'] = $data["user_auth"]->id_user;
    $data["title"] = "Data Petugas";
    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/user/v_user', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function create()
  {
    $data['title'] = "Tambah Petugas";
    $data['roles'] = $this->M_user->get_levels();
    $data['user_auth'] = get_logged_in_user();

    $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_space|is_unique[user.username]');
    $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim');
    $this->form_validation->set_rules('id_level', 'Level', 'required');

    $form_values = [
      "username" => $this->input->post('username', true),
      'nama_admin' => $this->input->post('nama_admin', true),
      'id_level' => $this->input->post('id_level', true),
    ];

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('form_values', $form_values);
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar_admin', $data);
      $this->load->view('layouts/header_admin', $data);
      $this->load->view('admin/user/v_user_create', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {

      //  dapatkan ID User dengan menggunakan fungsi GetAutoNumber
      $new_id_user  = GetAutoNumber("user", "id_user", "USR", 7);
      $data_post = array(
        "id_user" => $new_id_user,
        'username' => strtolower($form_values['username']),
        // Hash password menggunakan password_hash tetapi menggunaka default password yaitu "USER123" dan algoritma BCRYPT
        'password' => password_hash('USER123', PASSWORD_BCRYPT),
        'nama_admin' => $form_values['nama_admin'],
        'id_level' => $form_values['id_level'],
      );

      $this->M_user->add_user($data_post);

      $this->session->set_flashdata('message_success', 'User berhasil ditambahkan');
      redirect('/administrator/petugas');
    }
  }

  public function update($id)
  {
    $data['title'] = "Ubah Petugas ";
    $data['roles'] = $this->M_user->get_levels();
    $data['user_auth'] = get_logged_in_user();

    $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_space');
    $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim');
    $this->form_validation->set_rules('id_level', 'Level', 'required');
    $user = $this->M_user->get_user_by_id($id);

    if (!$user) {
      $this->session->set_flashdata('message_warning', 'Seperti terjadi kesalahan saat mengakses detail data petugas! pastikan ID petugas sudah benar');
      redirect(base_url('administrator/petugas'));
    }

    if ($user->id_user === $data['user_auth']->id_user) {
      $this->session->set_flashdata('message_warning', 'Ubah data anda di halaman profil');
      redirect(base_url('administrator/petugas'));
    }

    if ($user->id_user === "ADM0000") {
      $this->session->set_flashdata('message_warning', 'Super Admin tidak dapat ubah!');
      redirect(base_url('administrator/petugas'));
    }

    $form_values = [
      "username" => $this->input->post('username', true),
      'nama_admin' => $this->input->post('nama_admin', true),
      'id_level' => $this->input->post('id_level', true),
    ];


    $data["user"] = $user;

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('form_values', $form_values);
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar_admin', $data);
      $this->load->view('layouts/header_admin', $data);
      $this->load->view('admin/user/v_user_edit', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {
      $post_data = [
        "username" => strtolower($form_values['username']),
        "nama_admin" => $form_values['nama_admin'],
        "id_level" => $form_values['id_level'],
      ];
      if ($this->input->post("reset_pw") === 'TRUE') {
        $post_data["password"] = password_hash('PLGN123', PASSWORD_BCRYPT);
        $this->session->set_flashdata('message_warning', 'Kata sandi untuk petugas <strong>' .  $user->id_user . '</strong> telah di reset ke default. <br> Kata sandi default : <strong>USER123</strong>');
      }

      $this->M_user->update_user($user->id_user, $post_data);

      $this->session->set_flashdata('message_success', 'User berhasil diubah');
      redirect('/administrator/petugas');
    }
  }

  public function delete($id)
  {
    // cek apakah id user yang dihapus sama dengan id user saat ini


    $user = $this->M_user->get_user_by_id($id);

    if (!$user) {
      $this->session->set_flashdata('message_warning', 'Gagal menghapus petugas karena data ditemukan');
      redirect(base_url('administrator/petugas'));
    }

    if ($user->id_user === $this->session->userdata('id_user')) {
      $this->session->set_flashdata('message_warning', 'Gagal menghapus! Tidak bisa menghapus data sendiri');
      redirect(base_url('administrator/petugas'));
    } else {
      if ($user->id_user === "ADM0000") {
        $this->session->set_flashdata('message_error', 'Gagal menghapus! karena Super Admin tidak dapat dihapus!');
        redirect(base_url('administrator/petugas'));
      } else {

        $pays_are_made = $this->M_payment->get_pembayaran_by_id_user($id);

        if (empty($pays_are_made)) {
          $this->M_user->delete_user($id);
          $this->session->set_flashdata('message_success', 'Petugas <strong>' . $id . '</strong> berhasil dihapus');
          redirect(base_url('administrator/petugas'));
        } else {
          $this->session->set_flashdata('message_error', 'Gagal menghapus! terdapat beberapa data pembayaran yang dilakukan oleh petugas <strong>' . $id . '</strong>. Jadi sistem saat ini, tidak memperbolehkan untuk menghapus petugas yang telah melakukan konfirmasi pembayaran suatu tagihan!');
          redirect(base_url('administrator/petugas'));
        }
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
