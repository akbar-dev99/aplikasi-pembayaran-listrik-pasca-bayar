<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Util extends CI_Controller
{

  public function __construct()
  {

    parent::__construct();

    // load base_url
    $this->load->helper('url');
  }

  public function block()
  {
    $dash_page = "administrator";
    $session_role = $this->session->userdata('role');
    if ($session_role == "CUSTOMER") {
      $dash_page = "pelanggan";
    }
    $data["dash_page"] = $dash_page;
    $this->load->view('v_block', $data);
  }
}
