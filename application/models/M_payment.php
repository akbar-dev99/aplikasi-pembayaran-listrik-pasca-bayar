<?php
class M_payment extends CI_Model
{

  public function get_all_pembayaran($where = NULL)
  {
    $this->db->select('pembayaran.*, tagihan.*, pelanggan.*, user.*');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan');
    $this->db->join('user', 'user.id_user = pembayaran.id_user');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
    if (!empty($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
  }

  // public function get_pembayaran($where = null)
  // {
  //   $this->db->select('pembayaran.*, tagihan.*, pelanggan.*, user.*');
  //   $this->db->from('pembayaran');
  //   $this->db->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan');
  //   $this->db->join('user', 'user.id_user = pembayaran.id_user');
  //   $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
  //   $query = $this->db->get();
  //   return $query->result();
  // }

  public function get_pembayaran_by_id_user($id_user)
  {
    $this->db->select('*');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
    $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->where('pembayaran.id_user', $id_user);
    $query = $this->db->get();
    return $query->result();
  }

  public function insert_pembayaran($data)
  {
    return $this->db->insert('pembayaran', $data);
  }
}
