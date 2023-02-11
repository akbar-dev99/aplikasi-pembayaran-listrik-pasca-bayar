<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PaymentCustomer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_customer_login();
  }


  public function index()
  {
    $user_auth = get_logged_in_customer();
    $data["title"] = "Data Pembayaran";
    $data['user_auth'] = $user_auth;
    $data['pays'] =  $this->M_payment->get_all_pembayaran(["pembayaran.id_pelanggan" => $user_auth->id_pelanggan]);

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar', $data);
    $this->load->view('layouts/header', $data);
    $this->load->view('v_cs_pay', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }
}
