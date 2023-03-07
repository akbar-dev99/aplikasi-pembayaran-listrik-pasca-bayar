<?php
function is_customer_login()
{
  $CI = &get_instance();
  $is_login = $CI->session->has_userdata("logged_in", TRUE);
  if (!$is_login) {
    $CI->session->set_flashdata('message_error', 'Silahkan login terlebih dahulu!');
    redirect('pelanggan/masuk');
  }

  $role = $CI->session->userdata("role");
  if (strpos($role, 'CUSTOMER') === false) {
    redirect('akses/block');
  }
}

function get_logged_in_customer()
{
  $CI = &get_instance();
  $session = $CI->session->userdata();
  $id = $session["id_pelanggan"];
  return $CI->M_customer->get_customer_by_id($id);
}


function is_customer_already_logged_in()
{
  $CI = &get_instance();
  if ($CI->session->has_userdata('customer')) {
    redirect('pelanggan');
  }
}
