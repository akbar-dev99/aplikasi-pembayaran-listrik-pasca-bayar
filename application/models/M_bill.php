<?php

/**
 * Class TagihanModel
 *
 * @description Model untuk manajemen data tagihan
 *
 * @package     Models
 * @subpackage  TagihanModel
 * @category    Model
 */

class M_bill extends CI_Model
{
  /**
   * @description  Menambahkan data tagihan baru ke dalam tabel "tagihan"
   * @param $data - array yang berisi data tagihan baru yang akan ditambahkan ke tabel "tagihan"
   * @return void
   */
  public function insert_tagihan($data)
  {
    $this->db->insert('tagihan', $data);
  }

  /**
   * @description Mengupdate data tagihan dalam tabel "tagihan" berdasarkan kriteria tertentu
   *
   * @param array $where Kriteria pencarian data tagihan
   * @param array $data Data tagihan yang akan diupdate
   * @return void
   */
  public function update_tagihan($where, $data)
  {
    $this->db->where($where);
    $this->db->update('tagihan', $data);
  }

  /**
   * @description Mengambil seluruh data tagihan dari tabel "tagihan"
   *
   * @param array $where Kriteria pencarian data tagihan (optional)
   * @return array Seluruh data tagihan dari tabel "tagihan"
   */
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

  /**
   * @description Mengambil data tagihan berdasarkan id_penggunaan, id_pelanggan, bulan, dan tahun
   *
   * @param string $id_usage Id_penggunaan dari data tagihan yang diinginkan
   * @param string $id_cs Id_pelanggan dari data tagihan yang diinginkan
   * @param int $m Bulan dari data tagihan yang diinginkan
   * @param int $yr Tahun dari data tagihan yang diinginkan
   * @return object Data tagihan yang diinginkan
   */
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

  /**
   * Mengambil data tagihan berdasarkan id_tagihan
   *
   * @param string $id Id_tagihan dari data tagihan yang diinginkan
   * @return object Data tagihan yang diinginkan
   */
  public function get_tagihan_by_id($id)
  {
    // ini dilakukan karena tidak mungkin menuliskan setiap field dari tabel tagihan secara manual dalam select statement
    $this->db->select('*');
    $this->db->from('tagihan');
    $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan');
    $this->db->join('tarif', 'pelanggan.id_tarif = tarif.id_tarif');
    $this->db->where('id_tagihan', $id);
    $query = $this->db->get();
    return $query->row();
  }

  /**
   * @description Menghitung total tagihan pelanggan
   *
   * @param string $id_customer Id_pelanggan dari data tagihan yang akan dihapus
   * @param int $m Bulan dari data tagihan yang akan dihapus
   * @param int $yr Tahun dari data tagihan yang akan dihapus
   * @return void
   */


  // public function sum_total_tagihan($id_pelanggan, $bulan, $tahun)
  // {
  //   // Ambil data penggunaan listrik untuk pelanggan dan bulan/tahun tertentu
  //   $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
  //   $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
  //   $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
  //   $this->db->where('tagihan.id_pelanggan', $id_pelanggan);
  //   // $this->db->where('tagihan.bulan', $bulan);
  //   // $this->db->where('tagihan.tahun', $tahun);
  //   $this->db->where('status', 'UNPAID');
  //   $query = $this->db->get('tagihan');

  //   $total_tagihan = 0;

  //   // Jika ada data penggunaan, hitung total tagihan
  //   if ($query->num_rows() > 0) {
  //     $penggunaan = $query->row();

  //     // Ambil data tarif berdasarkan daya yang dimiliki pelanggan
  //     $this->db->where('daya', $penggunaan->daya);
  //     $query = $this->db->get('tarif');
  //     $tarif = $query->row();

  //     // Hitung jumlah meter yang digunakan
  //     $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;

  //     // Hitung total tagihan berdasarkan jumlah meter dan tarif per kWh
  //     $total_tagihan = $jumlah_meter * $tarif->tarif_perkwh;
  //   }

  //   return $total_tagihan;
  // }

  /**
   * @description Menghitung total tagihan pelanggan yang belum bayar
   *
   * @param string $id_customer Id_pelanggan dari data tagihan yang akan dihapus
   * @return integer
   */
  public function get_total_unpaid_tagihan($id_cs)
  {
    $this->db->select('SUM(jumlah_meter*tarif_perkwh) as total_tagihan');
    $this->db->from('tagihan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
    $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->where('tagihan.status', 'UNPAID');
    $this->db->where('tagihan.id_pelanggan', $id_cs);
    $query = $this->db->get();
    $result = $query->row();

    return $result->total_tagihan;
  }



  /**
   * @description Menghapus data tagihan berdasarkan id_penggunaan, id_pelanggan, bulan, dan tahun pada tabel "tagihan"
   *
   * @param string $id_usage Id_penggunaan dari data tagihan yang akan dihapus
   * @param string $id_customer Id_pelanggan dari data tagihan yang akan dihapus
   * @param int $m Bulan dari data tagihan yang akan dihapus
   * @param int $yr Tahun dari data tagihan yang akan dihapus
   * @return void
   */
  public function delete_tagihan_by_usage_and_period($id_usage, $id_customer, $m, $yr)
  {
    $this->db->where('id_penggunaan', $id_usage);
    $this->db->where('id_pelanggan', $id_customer);
    $this->db->where('bulan', $m);
    $this->db->where('tahun', $yr);
    $this->db->delete('tagihan');
  }

  /**
   * @description Memperbarui status pada data tagihan berdasarkan id_tagihan pada tabel "tagihan"
   *
   * @param string $id Id_tagihan dari data tagihan yang akan diperbarui statusnya
   * @param string $status Status baru yang akan diupdate pada data tagihan
   * @return bool True jika proses update berhasil, False jika gagal
   */
  public function update_tagihan_status_by_id($id, $status)
  {
    $this->db->set('status', $status);
    $this->db->where('id_tagihan', $id);
    return $this->db->update('tagihan');
  }
}
