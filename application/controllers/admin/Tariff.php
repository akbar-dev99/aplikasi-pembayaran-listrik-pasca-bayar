<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Tariff
 *
 * @description Controller untuk halaman dan mengatur fitur profile pelanggan
 *
 * @package     Admin Controller
 * @subpackage  Tariff
 * @category    Controller
 */
class Tariff extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_user_login();
  }

  public function index()
  {
    $data['user_auth'] = get_logged_in_user();
    $data["title"] = "Tarif";
    $data['tariffs'] = $this->M_tariff->get_tariffs();
    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/tariff/v_tariff', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }


  public function create()
  {
    $this->form_validation->set_rules('daya', 'Daya', 'required');
    $this->form_validation->set_rules('tarif_perkwh', 'Tarif per KWH', 'required|numeric');

    if ($this->form_validation->run() === FALSE) {

      $this->session->set_flashdata('error', 'VALIDATION');
      $this->index();
    } else {
      $data = array(
        'id_tarif' => GetAutoNumber("tarif", "id_tarif", "TRF", 14),
        'daya' => $this->input->post('daya'),
        'tarif_perkwh' => $this->input->post('tarif_perkwh')
      );
      $this->M_tariff->create_tariff($data);
      $this->session->set_flashdata('message_success', 'Berhasil menambah tarif');
      redirect('administrator/tarif');
    }
  }

  public function getUpdate($id)
  {
    $tariff = $this->M_tariff->get_tariff_by_id($id);
    $data['tariff'] = $tariff;
    $data['user_auth'] = get_logged_in_user();
    $data["title"] = "Edit Tarif : " . $tariff->id_tarif;

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar_admin', $data);
    $this->load->view('layouts/header_admin', $data);
    $this->load->view('admin/tariff/v_tariff_edit', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function update($id)
  {
    $this->form_validation->set_rules('daya', 'Daya', 'required');
    $this->form_validation->set_rules('tarif_perkwh', 'Tarif per KWH', 'required');

    if ($this->form_validation->run() === FALSE) {
      // $data['tarif'] = $this->M_tariff->get_tariff($id);
      $this->getUpdate($id);
    } else {
      $data = array(
        'daya' => $this->input->post('daya'),
        'tarif_perkwh' => $this->input->post('tarif_perkwh')
      );

      $this->M_tariff->update_tariff($id, $data);
      $this->session->set_flashdata('message_success', 'Berhasil mengupdate tarif');
      redirect('administrator/tarif');
    }
  }


  public function delete($id)
  {

    $this->M_tariff->delete_tariff($id);
    $this->session->set_flashdata('message_success', 'Berhasil menghapus tarif');
    redirect('administrator/tarif');
  }
}
