<!--  -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class DashboardModel
 *
 * @description Model untuk manajemen data untuk dashboard
 *
 * @package     Models
 * @subpackage  DashboardModel
 * @category    Model
 */
class M_dashboard extends CI_Model
{
  public function recap_pembayaran()
  {
    // tanggal sekarang
    $tgl_sekarang = date('Y-m-d');
    // tanggal awal dan tanggal akhir bulan ini
    $tgl_awal = date('Y-m-01', strtotime($tgl_sekarang));
    $tgl_akhir = date('Y-m-t', strtotime($tgl_sekarang));
    // query untuk mengambil data pembayaran bulan ini
    $this->db->select('SUM(total_bayar) as jumlah_pembayaran');
    $this->db->from('pembayaran');
    $this->db->where('tgl_bayar >=', $tgl_awal);
    $this->db->where('tgl_bayar <=', $tgl_akhir);
    $query = $this->db->get();
    // simpan hasil query ke variabel
    $result = $query->row();

    return $result->jumlah_pembayaran;
  }

  public function get_total_revenue()
  {
    // ambil data total revenue dari tabel pembayaran
    $this->db->select('SUM(total_bayar) AS total_revenue');
    $this->db->from('pembayaran');
    $this->db->where('YEAR(tgl_bayar)', date('Y'));
    $query = $this->db->get();
    $result = $query->row();
    return $result->total_revenue;
  }


  public function count_customers()
  {

    $this->db->select('id_pelanggan');
    $this->db->from('pelanggan');
    return $this->db->count_all_results();
  }

  public function count_bills_last_month()
  {
    $bulan_sekarang = date("n");
    $tahun_sekarang = date("Y");
    if ($bulan_sekarang == 1) {
      $bulan_kemarin = 12;
      $tahun_kemarin = $tahun_sekarang - 1;
    } else {
      $bulan_kemarin = $bulan_sekarang - 1;
      $tahun_kemarin = $tahun_sekarang;
    }

    $this->db->select('id_tagihan');
    $this->db->from('tagihan');
    $this->db->where('bulan', $bulan_kemarin);
    $this->db->where('tahun', $tahun_kemarin);
    $count_bills = $this->db->count_all_results();

    $this->db->select('id_tagihan');
    $this->db->from('tagihan');
    $this->db->where('bulan', $bulan_kemarin);
    $this->db->where('tahun', $tahun_kemarin);
    $this->db->where('status', 'UNPAID');
    $count_unpaid_bills = $this->db->count_all_results();

    $data['count_bills'] = $count_bills;
    $data['count_unpaid_bills'] = $count_unpaid_bills;
    $data["month"] = $bulan_kemarin;
    $data["year"] = $tahun_kemarin;
    return $data;
  }

  public function get_latest_customers()
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->limit(6);
    $this->db->order_by('id_pelanggan', 'desc');
    return $this->db->get()->result();
  }

  public function get_lastest_tagihan($id_cs = NULL)
  {
    $this->db->select('tagihan.*, pelanggan.nama_pelanggan, penggunaan.bulan, penggunaan.tahun, tarif.tarif_perkwh');
    $this->db->from('tagihan');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
    $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    if ($id_cs) {
      $this->db->where('tagihan.id_pelanggan', $id_cs);
    }
    $this->db->limit(6);
    $this->db->order_by('id_tagihan', 'desc');

    $query = $this->db->get();
    return $query->result();
  }

  // Customer Dashboard
  public function count_tagihan_pelanggan($id_cs)
  {
    $this->db->select('id_tagihan');
    $this->db->from('tagihan');
    $this->db->where('id_pelanggan', $id_cs);
    $this->db->where('status', 'UNPAID');
    return $this->db->count_all_results();
  }

  public function count_transaksi_pelanggan($id_cs)
  {
    $this->db->select('id_pembayaran');
    $this->db->from('pembayaran');
    $this->db->where('id_pelanggan', $id_cs);
    return $this->db->count_all_results();
  }

  public function get_total_pembayaran_pelanggan($id_cs)
  {
    // ambil data total revenue dari tabel pembayaran
    $this->db->select('SUM(total_bayar) AS total_revenue');
    $this->db->from('pembayaran');
    $this->db->where('YEAR(tgl_bayar)', date('Y'));
    $this->db->where('id_pelanggan', $id_cs);
    $query = $this->db->get();
    $result = $query->row();
    return $result->total_revenue;
  }



  public function get_grafik_penggunaan_pelanggan($id_cs = NULL)
  {


    if ($id_cs) {
      $this->db->select('bulan, tahun, SUM(meter_akhir - meter_awal) as total_pemakaian');
      $this->db->where('id_pelanggan', $id_cs);
      $this->db->group_by(array("bulan", "tahun"));
      $query = $this->db->get('penggunaan');
    } else {
      $this->db->select('bulan, tahun, SUM(meter_akhir - meter_awal) as total_pemakaian');
      $this->db->group_by(array("bulan", "tahun"));
      $query = $this->db->get('penggunaan');
    }

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $data) {
        $hasil[] = $data;
      }
      return $hasil;
    }
  }
}
