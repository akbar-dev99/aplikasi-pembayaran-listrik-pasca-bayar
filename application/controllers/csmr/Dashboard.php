<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_customer_login();
    }


    public function index()
    {
        $data['user_auth'] = get_logged_in_customer();
        $data['title'] = "Dashboard Pelanggan";
        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('v_dashboard', $data);
        $this->load->view('layouts/footer', $data);
        $this->load->view('layouts/end', $data);
    }
}
