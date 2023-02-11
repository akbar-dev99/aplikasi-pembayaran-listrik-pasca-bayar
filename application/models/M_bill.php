<?php
class M_bill extends CI_Model
{
  //insert data ke tabel "tagihan"
  public function insert_tagihan($data)
  {
    $this->db->insert('tagihan', $data);
  }

  //insert data ke tabel "tagihan"
  public function update_tagihan($where, $data)
  {
    $this->db->where($where);
    $this->db->update('tagihan', $data);
  }


  public function get_all_tagihan($where = NULL)
  {
    $this->db->select('tagihan.*, pelanggan.nama_pelanggan, penggunaan.bulan, penggunaan.tahun, tarif.tarif_perkwh');
    $this->db->from('tagihan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
    $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');

    if (!empty($where)) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
  }


  public function get_data_tagihan_by_period($id_usage, $id_cs, $m, $yr)
  {
    $this->db->select("tagihan.*, penggunaan.*, pelanggan.*");
    $this->db->from('tagihan');
    $this->db->join('penggunaan', 'tagihan.id_penggunaan = penggunaan.id_penggunaan');
    $this->db->join('pelanggan', 'tagihan.id_pelanggan = pelanggan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    $this->db->where('penggunaan.id_penggunaan', $id_usage);
    $this->db->where('tagihan.id_pelanggan', $id_cs);
    $this->db->where('penggunaan.bulan', $m);
    $this->db->where('penggunaan.tahun', $yr);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_tagihan_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('tagihan');
    $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    $this->db->where('id_tagihan', $id);
    $query = $this->db->get();
    return $query->row();
  }


  public function delete_tagihan_by_usage_and_period($id_usage, $id_customer, $m, $yr)
  {
    $this->db->where('id_penggunaan', $id_usage);
    $this->db->where('id_pelanggan', $id_customer);
    $this->db->where('bulan', $m);
    $this->db->where('tahun', $yr);
    $this->db->delete('tagihan');
  }

  public function update_tagihan_status_by_id($id, $status)
  {
    $this->db->set('status', $status);
    $this->db->where('id_tagihan', $id);
    return $this->db->update('tagihan');
  }
}
