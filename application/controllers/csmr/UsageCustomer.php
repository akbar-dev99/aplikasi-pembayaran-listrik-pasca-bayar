<?php


/**
 * Class Login
 *
 * @description Controller untuk halaman dan mengatur fitur penggunaan listrik pelanggan
 *
 * @package     Customer Controller
 * @subpackage  Login
 * @category    Controller
 */
class UsageCustomer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_customer_login();
  }

  public function index()
  {
    $user_auth = get_logged_in_customer();
    $data["title"] = "Data Penggunaan";
    $data['user_auth'] = $user_auth;
    $data['usages'] = $this->M_usage->get_penggunaan_pelanggan($user_auth->id_pelanggan);

    $this->load->view('layouts/head', $data);
    $this->load->view('layouts/sidebar', $data);
    $this->load->view('layouts/header', $data);
    $this->load->view('v_cs_usage', $data);
    $this->load->view('layouts/footer', $data);
    $this->load->view('layouts/end', $data);
  }

  public function create()
  {
    $user_auth = get_logged_in_customer();
    $data["title"] = "Data Penggunaan";
    $data['user_auth'] = $user_auth;
    $data["lock_init_meter"] = FALSE;
    $data['is_update'] = FALSE;
    $customer = $this->M_customer->get_customer_by_id($user_auth->id_pelanggan);


    $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'required|numeric',  [
      'required' => 'Meter Akhir Tidak Boleh Kosong!',
      'numeric' => 'Meter Akhir harus berupa angka!',
    ]);

    $data["customer"] = $customer;
    //mengambil tgl saat ini dengan fungsi date
    $current_date = date("Y-m-d");
    //konversikan tgl saat ini ke bulan and tahun
    $month = date("m", strtotime($current_date));
    $year = date("Y", strtotime($current_date));

    // cek apakah data penggunaan sudah ada untuk pelanggan tertentu pada bulan dan tahun yang sama
    $check_usage_by_period = $this->M_usage->check_period_penggunaan($customer->id_pelanggan, $month, $year);

    // mengambil data meter_akhir untuk bulan sebelumnya dan dijadikan meter_awal untuk bulan ini
    $init_meter = $this->M_usage->get_pelanggan_meter_akhir($customer->id_pelanggan);
    $get_bill = NULL;
    if ($check_usage_by_period) {
      $data['is_update'] = TRUE;
      $get_usage_by_period_data = $this->M_usage->get_penggunaan_by_period($customer->id_pelanggan, $month, $year);
      $get_bill = $this->M_bill->get_data_tagihan_by_period(
        $get_usage_by_period_data->id_penggunaan,
        $customer->id_pelanggan,
        number_format($month),
        $year,
      );

      if ($get_bill->status == "PAID") {
        $this->session->set_flashdata('message_error', 'Penggunaan anda untuk periode ' . MonthToString($get_usage_by_period_data->bulan) . ' ' . $get_usage_by_period_data->tahun . ' atau bulan ini telah di input dan tagihannya telah lunas!');
        $this->session->set_flashdata('message_info', 'Penginputan data penggunaan pelanggan ' . $customer->id_pelanggan . ' dapat dilakukan bulan depan!');
        redirect(base_url('pelanggan/penggunaan'));
      }
    }

    // mengambil data penggunaan pelanggan yang telah ada, kemudian di filter untuk mendapat data yang tidak sesuai dengan periode input saat ini.
    $count_cs_usage = array_filter($this->M_usage->get_all_penggunaan(["penggunaan.id_pelanggan" => $customer->id_pelanggan]), fn ($val) => ($val->bulan != intval($month) || $val->tahun != $year));

    $post_init_meter = $this->input->post("meter_awal");
    $post_last_meter = $this->input->post("meter_akhir");
    // $post_last_meter =
    // statement dibawah ini berfungsi untuk mengecek apakah input penggunaan kali merupakan inputan penggunaan yang pertaman kali, jika ya maka meter_awal di ambil dari form input. jika tidak maka meter_awal ditentukan oleh meter_akhir dari data varibael $check_usage_by_period;
    if ($init_meter > 0) {

      if (count($count_cs_usage) > 0) {
        $data["lock_init_meter"] = TRUE;
        $post_init_meter = $init_meter;
      } else {
        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'required|numeric',  [
          'required' => 'Meter Awal Tidak Boleh Kosong!',
          'numeric' => 'Meter Awal harus berupa angka!',
        ]);
      }
    }



    $form_values = [
      'bulan' => MonthToString($month),
      'tahun' => $year,
      'meter_awal' => $post_init_meter,
      'meter_akhir' => $post_last_meter,
    ];

    if ($this->form_validation->run() === false) {
      $this->session->set_flashdata('form_values', $form_values);
      $this->load->view('layouts/head', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('layouts/header', $data);
      $this->load->view('v_cs_usage_create', $data);
      $this->load->view('layouts/footer', $data);
      $this->load->view('layouts/end', $data);
    } else {

      if ($post_last_meter <= $post_init_meter) {
        $this->session->set_flashdata('form_values', $form_values);
        $this->session->set_flashdata('message_error', 'Meter akhir tidak mungkin kurang dari meter awal');
        redirect(base_url('pelanggan/penggunaan/input'));
      }

      // pengecekan apakah periode penggunaan bulan ini telah ada.
      if (!$check_usage_by_period) {
        // Jika tidak, akan di input sebagai data penggunaan baru
        $new_usage_data = [
          "meter_akhir" => $post_last_meter,
          "meter_awal" => $post_init_meter,
          "bulan" => date("m", strtotime(date('Y-m-d') . " -1 month")),
          "tahun" => date("Y", strtotime(date('Y-m-d') . " -1 month")),
          // "bulan" => $month,
          // "tahun" => $year,
          "id_pelanggan" => $customer->id_pelanggan
        ];
        // Generate id penggunaan untuk inputan saat ini.
        $new_id_usage = GetAutoNumber("penggunaan", "id_penggunaan", "PN" . date("ymd"), 11);
        // tambahkan id penggunaan dan id pelanggan di kedalam array penggunaan baru;
        $new_usage_data["id_penggunaan"] = $new_id_usage;

        // menyimpan data penggunaan
        $this->M_usage->insert_penggunaan($new_usage_data);

        /* Kode berikut merupakan insert data kedalam tabel tagihan, bersamaan dengan insert data pelanggan. akan tetapi di beri komentar karena telah dibuat SQL Trigger untuk insert data tagihan saat query insert penggunaan.
        // hitung jumlah meter dan array data tagihan
        $total_meter = $post_last_meter - $post_init_meter;
        $data_bill = array(
          'id_tagihan' => GetAutoNumber("tagihan", "id_tagihan", "TG" . date("ymd"), 12),
          'id_penggunaan' => $new_id_usage,
          'id_pelanggan' => $customer->id_pelanggan,
          "bulan" => $month,
          "tahun" => $year,
          'jumlah_meter' => $total_meter,
          'status' => "UNPAID"
        );
        $this->M_bill->insert_tagihan($data_bill);
        */
        $this->session->set_flashdata('message_success', 'Berhasil menambah penggunaan dan tagihan');
        redirect(base_url('pelanggan/penggunaan'));
      } else {
        // Jika ya, maka data periode bulan ini akan di ubah akan di ubah.
        $get_usage_by_period_data = $this->M_usage->get_penggunaan_by_period($customer->id_pelanggan, $month, $year);
        // cek jika telah melakukan pembayaran untuk period ditentukan
        if ($get_bill->status === "PAID") {
          $this->session->set_flashdata('message_warning', 'Penggunaan anda untuk periode bulan ini telah dibuatkan tagihan dan sudah lunas. Untuk penginputan data penggunaan dapat dilakukan bulan depan. Terima kasih');
          redirect(base_url('pelanggan/penggunaan'));
        } else {
          $total_meter = $post_last_meter - $post_init_meter;
          $this->M_usage->update_penggunaan($get_usage_by_period_data->id_penggunaan, ["meter_akhir" => $post_last_meter, "meter_awal" => $post_init_meter]);
          // update data tagihan
          $this->M_bill->update_tagihan(["id_tagihan" => $get_bill->id_tagihan], ["jumlah_meter" => $total_meter]);
          $this->session->set_flashdata('message_success', 'Berhasil memperbaharui data penggunaan anda.');
          redirect(base_url('pelanggan/penggunaan'));
        }
      }
    }
  }

  public function delete($id)
  {
    // Cek data penggunaan apakah $id yang direquest sesuai dangan id_pelanggan;
    $check = $this->M_usage->get_penggunaan_by_id($id);

    if ($check) {
      $id_usage = $check->id_penggunaan;
      $id_customer = $check->id_pelanggan;
      $usage_month = $check->bulan;
      $usage_year = $check->tahun;
      // Ambil data tagihan dari tabel tagihan
      $check_bill = $this->M_bill->get_data_tagihan_by_period($id_usage, $id_customer, $usage_month, $usage_year);
      // cek apakah tagihan ada, jika ya hapus penggunaan bersama data tagihannya
      if ($check_bill) {
        // Cek apakah tagihan sudah lunas!
        if ($check_bill->status === "PAID") {
          // Jika ya batalkan dan menampilkan pesan error
          $this->session->set_flashdata('message_error', 'Tidak bisa menghapus data penggunaan periode ' . MonthToString($usage_month) . ' ' . $usage_year . ', karena tagihannya sudah lunas');
          redirect(base_url('pelanggan/penggunaan'));
        } else {
          // Jika tidak hapus penggunaan dan tagihannya
          $this->M_usage->delete_penggunaan($id_usage);
          $this->M_bill->delete_tagihan_by_usage_and_period($id_usage, $id_customer, $usage_month, $usage_year);

          $this->session->set_flashdata('message_success', 'Berhasil menghapus data pengunaan anda!!');
          redirect(base_url('pelanggan/penggunaan'));
        }
      } else {
        $this->M_usage->delete_penggunaan($id);
        $this->session->set_flashdata('message_success', 'Berhasil menghapus data pengunaan anda!');
        redirect(base_url('pelanggan/penggunaan'));
      }
    } else {
      $this->session->set_flashdata('message_error', 'Gagal menghapus penggunaan karena ID penggunaan yang di dikirim tidak tersedia!');
      redirect(base_url('pelanggan/penggunaan'));
    }
  }
}
