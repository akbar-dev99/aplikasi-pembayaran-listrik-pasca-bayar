<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Dashboard Admin
 *
 * @description Controller untuk halaman dan mengatur fitur pelanggan
 *
 * @package     Admin Controller
 * @subpackage  Dashboard Admin
 * @category    Controller
 */
class DashboardAdmin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }

  public function index()
  {

    $data['user_auth'] = get_logged_in_user();
    $data["title"] = "Dashboard";
    $data["payment_recap"] = $this->M_dashboard->recap_pembayaran();
    $data["total_revenue"] = $this->M_dashboard->get_total_revenue();

    // Ambil data jumlah semua tagihan
    $data['count_biils'] = $this->M_dashboard->count_bills_last_month();
    $data['count_cs'] = $this->M_dashboard->count_customers();
    $data['latest_cs'] = $this->M_dashboard->get_latest_customers();
    $data['latest_bills'] = $this->M_dashboard->get_lastest_tagihan();
    $data["usage_grafik"] = $this->M_dashboard->get_grafik_penggunaan_pelanggan();
    $data["scripts"] = ['admin/_script/sc_dashboard'];
    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/v_dashboard', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }
}
