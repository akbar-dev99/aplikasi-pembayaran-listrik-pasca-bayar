<?php

$bulan = "";
$tahun = "";
$meter_awal = "";
$meter_akhir = "";

if ($this->session->flashdata('form_values')) {
  $values = $this->session->flashdata('form_values');
  $bulan = $values['bulan'];
  $tahun = $values['tahun'];
  $meter_awal = $values['meter_awal'];
  $meter_akhir = $values['meter_akhir'];
}

?>

<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-lg-8">
        <?php $this->load->view('layouts/flashdata'); ?>
        <div class="card">
          <div class="card-body">
            <form action="<?php echo site_url('administrator/penggunaan/input/' . $customer->id_pelanggan); ?>" method="post">

              <div class="row mb-3">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" form-label" for="bulan">Bulan</label>
                    <input type="text" class="form-control form-control-lg " id="bulan" name="bulan" readonly value="<?= $bulan ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" form-label " for="tahun">Tahun</label>
                    <input type="text" class="form-control form-control-lg " id="tahun" name="tahun" readonly value="<?= $tahun ?>">
                  </div>
                </div>
              </div>
              <div class="row ">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" form-label " for="meter_awal">Meter Awal</label>
                    <input type="text" class="form-control form-control-lg" id="meter_awal" name="meter_awal" readonly value="<?= $meter_awal ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class=" form-label " for="meter_akhir">Meter Akhir</label>
                    <input type="text" class="form-control form-control-lg" id="meter_akhir" name="meter_akhir" value="<?= $meter_akhir ?>">
                    <?= form_error('meter_akhir', '<small class="text-danger">', '</small>'); ?>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <a href="<?= base_url("administrator/pelanggan") ?>" class="btn btn-link btn-lg ">Batal</a>
                <button type="submit" class="btn btn-primary btn-lg ">Simpan</button>
              </div>
            </form>

          </div>
        </div>
      </div>
      <div class="col-12 col-md-auto col-lg-4">

        <div class="card border">
          <div class="card-header px-3">
            Detail Data Pelanggan
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">ID Pelanggan :</h5>
              <p class="mb-1"><?= $customer->id_pelanggan ?></p>
            </li>
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">Nama : </h5>
              <p class="mb-1"><?= $customer->nama_pelanggan ?></p>
            </li>
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">Alamat :</h5>
              <p class="mb-1"><?= $customer->alamat ?></p>
            </li>
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">Tarif (Daya) :</h5>
              <p class="mb-1"><?= Rupiah($customer->tarif_perkwh) ?> (<?= $customer->daya ?>)</p>
            </li>

          </ul>
        </div>

      </div>
    </div>

  </div>
</main>