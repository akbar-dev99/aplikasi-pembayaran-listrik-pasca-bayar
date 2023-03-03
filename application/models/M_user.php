<?php

/**
 * Class UserModel
 *
 * @description Model untuk manajemen data user / administrasi
 *
 * @package     Models
 * @subpackage  UserModel
 * @category    Model
 */
class M_user extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get_all_user()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->join('level', 'level.id_level = user.id_level');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_user_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->join('level', 'level.id_level = user.id_level');
    $this->db->where(array('id_user' => $id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_user($where = null)
  {
    // return $this->db->get_where('user', $where)->row_array();
    $this->db->select('user.*, level.`level`');
    $this->db->from('user');
    $this->db->join('level', 'level.id_level = user.id_level');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row();
  }

  public function add_user($data)
  {
    return $this->db->insert('user', $data);
  }

  public function update_user($id, $data)
  {
    $this->db->where(array('id_user' => $id));
    return $this->db->update('user', $data);
  }

  public function delete_user($id)
  {
    $this->db->where(array('id_user' => $id));
    return $this->db->delete('user');
  }

  public function get_levels()
  {
    return $this->db->get('level')->result_array();
  }
}
