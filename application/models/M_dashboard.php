<!--  -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');



defined('BASEPATH') or exit('No direct script access allowed');

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
}
