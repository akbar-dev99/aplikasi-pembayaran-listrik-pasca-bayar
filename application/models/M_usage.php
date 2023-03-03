<?php

/**
 * Class UsageModel
 *
 * @description Model untuk manajemen data penggunaan listrik
 *
 * @package     Models
 * @subpackage  UsageModel
 * @category    Model
 */
class M_usage extends CI_Model
{
  public function get_all_penggunaan($where = NULL)
  {
    $this->db->select('penggunaan.*, pelanggan.nama_pelanggan, tarif.daya');
    $this->db->from('penggunaan');
    $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    if (!empty($where)) {
      $this->db->where($where);
    }
    $this->db->order_by("id_penggunaan", "ASC");
    return $this->db->get()->result();
  }

  public function get_penggunaan_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('penggunaan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan');
    $this->db->where('id_penggunaan', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_penggunaan_pelanggan($id_cs)
  {
    $this->db->select('penggunaan.*, pelanggan.nama_pelanggan, tarif.daya');
    $this->db->from('penggunaan USE INDEX (idx_penggunaan_pelanggan)');
    $this->db->join('pelanggan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    $this->db->where('penggunaan.id_pelanggan', $id_cs);
    $this->db->order_by("id_penggunaan", "ASC");
    return $this->db->get()->result();
  }

  public function get_penggunaan_by_period($id_cus, $m, $yr)
  {
    $this->db->where('id_pelanggan', $id_cus);
    $this->db->where('bulan', $m);
    $this->db->where('tahun', $yr);
    $query = $this->db->get('penggunaan');

    return $query->row();
  }

  public function check_period_penggunaan($id_cus, $m, $yr)
  {
    $this->db->where('id_pelanggan', $id_cus);
    $this->db->where('bulan', $m);
    $this->db->where('tahun', $yr);
    $query = $this->db->get('penggunaan');
    return $query->num_rows();
  }


  function get_pelanggan_meter_akhir($id_cs)
  {
    $this->db->select('meter_akhir');
    $this->db->from('penggunaan');
    $this->db->where('id_pelanggan', $id_cs);
    $this->db->order_by('id_penggunaan', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->meter_akhir;
    }
    return 0;
  }



  public function update_penggunaan($id, $data)
  {
    $this->db->where('id_penggunaan', $id);
    $this->db->update('penggunaan', $data);
  }


  public function delete_penggunaan($id_penggunaan)
  {
    $this->db->where('id_penggunaan', $id_penggunaan);
    $this->db->delete('penggunaan');
  }

  public function insert_penggunaan($data)
  {
    $this->db->insert('penggunaan', $data);
    // $this-db->insert

    // // cek apakah data penggunaan sudah ada untuk pelanggan tertentu pada bulan dan tahun yang sama
    // $query = $this->db->get_where('penggunaan', array('id_pelanggan' => $id_cus, 'bulan' => $m, 'tahun' => $yr));
    // if ($query->num_rows() > 0) {
    //   $is_new = FALSE;
    //   // update data penggunaan yang sudah ada
    //   $this->db->update('penggunaan', $data, array('id_pelanggan' => $id_cus, 'bulan' => $m, 'tahun' => $yr));
    // } else {
    //   $is_new = TRUE;
    //   // tambahkan data penggunaan baru ke database
    //   $this->db->insert('penggunaan', $data);
    // }
    // return ["affected_rows" => $this->db->affected_rows(), "is_new" => $is_new];
  }
}
