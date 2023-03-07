<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class CustomerModel
 *
 * @description Model untuk manajemen data pelanggan
 *
 * @package     Models
 * @subpackage  CustomerModel
 * @category    Model
 */
class M_customer extends CI_Model
{
  /**
   * @description Mengambil data pelanggan berdasarkan id_pelanggan
   *
   * @param string $id Id_pelanggan dari data pelanggan yang diinginkan
   * @return object Data pelanggan yang diinginkan
   */
  public function get_customer_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->where('id_pelanggan', $id);
    return $this->db->get()->row();
  }

  /**
   * @description Mengambil data pelanggan berdasarkan username
   *
   * @param string $username Username dari data pelanggan yang diinginkan
   * @return object Data pelanggan yang diinginkan
   */
  public function get_customer_by_username($username)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array('username' => $username));
    $query = $this->db->get();

    return $query->row();
  }

  /**
   * @description Mengambil data pelanggan berdasarkan nomor kwh
   *
   * @param string $no_kwh nomor kwh untuk data pelanggan yang diinginkan
   * @return object Data pelanggan yang diinginkan
   */
  public function get_pelanggan_by_nomor_kwh($no_kwh)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    $this->db->where(array('nomor_kwh' => $no_kwh));
    $query = $this->db->get();
    return $query->row();
  }


  /**
   * @description Menambahkan data pelanggan ke dalam tabel "pelanggan"
   *
   * @param array $data Data pelanggan yang akan ditambahkan ke dalam tabel "pelanggan"
   * @return bool True jika data berhasil ditambahkan, false jika gagal
   */
  public function insert_customer($data)
  {
    return $this->db->insert('pelanggan', $data);
  }

  /**
   * @description Mengupdate data pelanggan berdasarkan id_pelanggan
   *
   * @param string $id Id_pelanggan dari data pelanggan yang akan diupdate
   * @param array $data Data pelanggan yang akan diupdate pada tabel "pelanggan"
   * @return bool True jika data berhasil diupdate, false jika gagal
   */
  public function update_customer($id, $data)
  {
    $this->db->where(array('id_pelanggan' => $id));
    return $this->db->update('pelanggan', $data);
  }

  /**
   * @description Mengambil seluruh data pelanggan beserta tarif listrik dari tabel "pelanggan" dan "tarif"
   *
   * @return array Data seluruh pelanggan beserta tarif listrik yang terdaftar dalam tabel "pelanggan" dan "tarif"
   */
  public function get_customers($where = NULL)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
    if (!empty($where)) {
      $this->db->where($where);
    }
    return $this->db->get()->result();
  }

  /**
   * @description Menghapus data pelanggan berdasarkan id_pelanggan
   *
   * @param string $id Id_pelanggan dari data pelanggan yang akan dihapus
   * @return bool True jika data berhasil dihapus, false jika gagal
   */
  public function delete_customer($id)
  {
    $this->db->where(array('id_pelanggan' => $id));
    return $this->db->delete('pelanggan');
  }

  /**
   * @description Memeriksa apakah data pelanggan pada id_pelanggan tertentu sudah terisi semua
   *
   * @param int $id_pelanggan Id_pelanggan dari data pelanggan yang akan diperiksa
   * @return bool True jika data sudah terisi semua, false jika ada data yang belum terisi
   */
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
