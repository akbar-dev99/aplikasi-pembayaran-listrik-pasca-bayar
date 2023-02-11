<?php
function is_user_login()
{
  $CI = &get_instance();
  $is_login = $CI->session->has_userdata("logged_in", TRUE);

  if (!$is_login) {
    redirect('administrator/masuk');
  }

  $id = $CI->session->userdata("id_user");
  $user = $CI->db->get_where('user', ['id_user' => $id])->row_array();
  if ($user) {
    return TRUE;
  } else {
    redirect('akses/block');
  }
}

function is_only_admin()
{
  $CI = &get_instance();
  $id = $CI->session->userdata("id_user");
  $user = $CI->M_user->get_user(['id_user' => $id]);
  if ("ADMIN" === $user->level) {
    return TRUE;
  } else {
    redirect('akses/block');
  }
}

function get_logged_in_user()
{
  $CI = &get_instance();
  $session = $CI->session->userdata();
  $id = $session["id_user"];
  return $CI->M_user->get_user(['id_user' => $id]);
  // return $CI->db->get_where('user', ['id_user' => $id])->row_array();
}


function is_user_already_logged_in()
{
  $CI = &get_instance();
  if ($CI->session->has_userdata('user')) {
    redirect('administrator');
  }
}
