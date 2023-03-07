<?php


/**
 * Class Bill
 *
 * @description Controller untuk halaman dan mengatur fitur tagihan listrik
 *
 * @package     Admin Controller
 * @subpackage  Bill
 * @category    Controller
 */

class Bill extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }

  public function index()
  {
    $data["title"] = "Data Tagihan";
    $data['bills'] = $this->M_bill->get_all_tagihan();

    $data['user_auth'] = get_logged_in_user();

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/bill/v_bill', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }


  public function detail($id)
  {
    $data['user_auth'] = get_logged_in_user();
    $data["title"] = "Detail Tagihan : - ";
    $data["req_id"] = $id;
    $bill = $this->M_bill->get_tagihan_by_id($id);


    $error_notfound = TRUE;

    if ($bill) {
      $error_notfound = FALSE;
      $data["title"] = "Detail Tagihan : " . $bill->id_tagihan;
      $admin_fee = AdminFee();
      $total_bill = $bill->tarif_perkwh * $bill->jumlah_meter;
      $total_pay = $total_bill + $admin_fee;
      $data["total_bill"] = Rupiah($total_bill);
      $data["admin_fee"] = Rupiah($admin_fee);
      $data["total_pay"] = Rupiah($total_pay);
    }

    $data["error"] = $error_notfound;
    $data["bill"] = $bill;

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/bill/v_bill_info', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }
}
