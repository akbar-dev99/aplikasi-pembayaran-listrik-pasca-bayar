<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Dashboard
 *
 * @description Controller untuk halaman Dashboard pelanggan
 *
 * @package     Customer Controller
 * @subpackage  Dashboard
 * @category    Controller
 */
class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_customer_login();
    }

    public function index()
    {
        $user_auth = get_logged_in_customer();
        $current_date = date("Y-m-d");
        $month = date("m", strtotime($current_date));
        $year = date("Y", strtotime($current_date));
        $data['user_auth'] = $user_auth;
        $data['title'] = "Dashboard Pelanggan";
        $data["arrears"] = $this->M_dashboard->count_tagihan_pelanggan($user_auth->id_pelanggan);
        $data["total_pays"] = $this->M_dashboard->get_total_pembayaran_pelanggan($user_auth->id_pelanggan);
        $data["count_transactions"] = $this->M_dashboard->count_transaksi_pelanggan($user_auth->id_pelanggan);
        $data['latest_bills'] = $this->M_dashboard->get_lastest_tagihan($user_auth->id_pelanggan);
        $data['sum_bill'] = $this->M_bill->get_total_unpaid_tagihan($user_auth->id_pelanggan);


        $data["usage"] = $this->M_usage->get_penggunaan_by_period($user_auth->id_pelanggan, $month, $year);

        $data["scripts"] = ['script/sc_dash'];
        $data["usage_grafik"] = $this->M_dashboard->get_grafik_penggunaan_pelanggan($user_auth->id_pelanggan);

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('v_dashboard', $data);
        $this->load->view('layouts/footer', $data);
        $this->load->view('layouts/end', $data);
    }
}
