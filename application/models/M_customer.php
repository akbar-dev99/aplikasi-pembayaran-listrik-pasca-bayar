<?php
defined('BASEPATH') or exit('No direct script access allowed');



defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{

  public function get_customers()
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    return $this->db->get()->result();
  }

  public function get_customer_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->where('id_pelanggan', $id);
    return $this->db->get()->row();
  }

  public function get_customer_by_username($username)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array('username' => $username));
    $query = $this->db->get();

    return $query->row();
  }

  public function insert_customer($data)
  {
    return $this->db->insert('pelanggan', $data);
  }

  public function update_customer($id, $data)
  {
    $this->db->where(array('id_pelanggan' => $id));
    return $this->db->update('pelanggan', $data);
  }

  public function delete_customer($id)
  {
    $this->db->where(array('id_pelanggan' => $id));
    return $this->db->delete('pelanggan');
  }

  public function check_customer_data_filled($id_pelanggan)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array('id_pelanggan' => $id_pelanggan));
    $query = $this->db->get();

    $customer = $query->row();
    $is_data_filled = true;

    foreach ($customer as $value) {
      if ($value == null) {
        $is_data_filled = false;
        break;
      }
    }

    return $is_data_filled;
  }
}
