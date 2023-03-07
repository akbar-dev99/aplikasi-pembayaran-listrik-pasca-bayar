<?php

$date_pay_val = "";
$total_pay_val = $total_pay_num;


if ($this->session->flashdata('form_values')) {
  $values = $this->session->flashdata('form_values');
  $date_pay_val = $values['tanggal_bayar'];
  if ($values['total_bayar']) {
    $total_pay_val = $values['total_bayar'];
  } else {
    $total_pay_val = $total_pay_num;
  }
}

?>

<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>
    </div>

    <?php if ($error) { ?>
      <div class="row">
        <div class="col-12">
          <div class="alert alert-danger" role="alert">
            Tidak dapat melakukan konfirmasi pembayaran. Karena Tagihan dengan ID <strong><?= $req_id ?></strong> tidak dapat ditemukan.
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <?php $this->load->view('layouts/flashdata'); ?>
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('administrator/tagihan/' . $bill->id_tagihan . '/pembayaran') ?>" method="post">
                <!-- <div class="row mb-3">
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label class="form-label" for="id_tagihan">ID Tagihan</label>
                      <input type="text" class="form-control form-control-lg " id="id_tagihan" readonly value="<?= $bill->id_tagihan ?>">
                      <?= form_error('id_tagihan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label class="form-label" for="id_tagihan">ID Pelanggan</label>
                      <input type="text" class="form-control form-control-lg " id="id_tagihan" readonly value="<?= $bill->id_pelanggan ?>">
                    </div>
                  </div>
                </div> -->
                <div class="form-group mb-3">
                  <label class="form-label" for="tanggal_bayar">Tanggal Bayar</label>
                  <input type="date" class="form-control form-control-lg " id="tanggal_bayar" name="tanggal_bayar" value="<?= $date_pay_val ?>" max="<?= $curr_date ?>">
                  <?= form_error('tanggal_bayar', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class=" form-group mb-3">
                  <label class="form-label" for="total_bayar">Jumlah Bayar</label>
                  <input type="text" class="form-control form-control-lg " id="total_bayar" name="total_bayar" value="<?= $total_pay_val ?>">
                  <?= form_error('total_bayar', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Bayar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">

            <div class="card-body ">
              <table class="table  ">
                <tr>
                  <td>
                    <h5>ID Tagihan</h5>
                  </td>
                  <td>
                    <h5 class=" text-capitalize "><?= $bill->id_tagihan ?></h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Nama Pelanggan</h5>
                  </td>
                  <td>
                    <h5 class=" text-capitalize "><?= $bill->nama_pelanggan ?></h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Nomor KWH</h5>
                  </td>
                  <td>
                    <h5><?= $bill->nomor_kwh ?></h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Periode</h5>
                  </td>
                  <td>
                    <h5><?= MonthToString($bill->bulan) ?> <?= $bill->tahun ?></h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Jumlah Meter</h5>
                  </td>
                  <td>
                    <h5><?= $bill->jumlah_meter ?></h5>
                  </td>
                </tr>

                <tr>
                  <td>
                    <h5>Total Tagihan</h5>
                  </td>
                  <td>
                    <h5><?= $total_bill ?></h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Biaya Admin</h5>
                  </td>
                  <td>
                    <h5><?= $admin_fee ?></h5>
                  </td>
                </tr>
                </tr>
                <tfoot>
                  <tr>
                    <td>
                      <h5 class=" fw-bold text-primary">Total</h5>
                    </td>
                    <td>
                      <h5 class=" fw-bold text-primary "><?= $total_pay ?></h5>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>




  </div>
</main>