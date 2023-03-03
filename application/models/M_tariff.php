<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class TariffModel
 *
 * @description Model untuk manajemen data tarif
 *
 * @package     Models
 * @subpackage  TariffModel
 * @category    Model
 */
class M_tariff extends CI_Model
{
  public function create_tariff($data)
  {
    return $this->db->insert('tarif', $data);
  }

  public function get_tariff_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('tarif');
    $this->db->where(array('id_tarif' => $id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_tariffs()
  {
    $query = $this->db->get('tarif');
    return $query->result_array();
  }

  public function update_tariff($id, $data)
  {
    $this->db->where('id_tarif', $id);
    $this->db->update('tarif', $data);
  }

  public function delete_tariff($id)
  {
    $this->db->where('id_tarif', $id);
    $this->db->delete('tarif');
  }
}
