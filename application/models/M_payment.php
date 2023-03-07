<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class PaymentModel
 *
 * @description Model untuk manajemen data pembayaran
 *
 * @package     Models
 * @subpackage  PaymentModel
 * @category    Model
 */
class M_payment extends CI_Model
{

  public function get_all_pembayaran($where = NULL)
  {
    $this->db->cache_on(); // aktifkan caching
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


  public function get_pembayaran_by_id_tagihan($id_bill)
  {
    $this->db->cache_on(); // aktifkan caching
    $this->db->select("*");
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan', "left");
    $this->db->where('pembayaran.id_tagihan', $id_bill);
    $query = $this->db->get();
    return $query->row();
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
    $this->db->cache_on(); // aktifkan caching
    $this->db->select('*');
    $this->db->from('pembayaran');
    $this->db->join('tagihan', 'pembayaran.id_tagihan = tagihan.id_tagihan');
    $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
    $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->where('pembayaran.id_user', $id_user);
    $query = $this->db->get();
    return $query->result();
  }


  public function get_unpaid_tagihan($id_pelanggan)
  {
    $this->db->select_sum('jumlah_meter');
    $this->db->from('tagihan');
    $this->db->join('pembayaran', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'left');
    $this->db->where('tagihan.id_pelanggan', $id_pelanggan);
    $this->db->where('pembayaran.id_pembayaran IS NULL', null, false);
    $query = $this->db->get();
    $result = $query->row_array();
    return $result['jumlah_meter'];
  }


  public function update_pembayaran($where, $data)
  {
    $this->db->where($where);
    $this->db->update('pembayaran', $data);
  }


  public function delete_pembayaran($pay_id)
  {
    $this->db->where('id_pembayaran', $pay_id);
    $this->db->delete('pembayaran');
  }

  public function insert_pembayaran($data)
  {
    return $this->db->insert('pembayaran', $data);
  }
}
