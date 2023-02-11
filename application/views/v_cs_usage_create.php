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
        <h3 class=" fw-bold "><?= $title ?> Periode <?= $bulan . " " . $tahun ?> </h3>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <?php $this->load->view('layouts/flashdata'); ?>
        <?php if ($is_update) : ?>
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            Sepertinya penggunaan untuk periode <strong><?= $bulan . " " . $tahun ?></strong> telah di input sebelumnya. Jadi penginputan data kali ini akan diperbaharui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-lg-8">

        <div class="card">
          <div class="card-body">
            <form action="<?php echo site_url('pelanggan/penggunaan/input'); ?>" method="post">

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
                    <?php if ($lock_init_meter) : ?>
                      <input type="text" class="form-control form-control-lg" id="meter_awal" name="meter_awal" readonly value="<?= $meter_awal ?>">
                    <?php else : ?>
                      <input type="text" class="form-control form-control-lg" id="meter_awal" name="meter_awal" value="<?= $meter_awal ?>">
                      <?= form_error('meter_awal', '<small class="text-danger">', '</small>'); ?>

                    <?php endif; ?>

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
            Informasi
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">Penggunaan untuk periode :</h5>
              <p class="mb-1"><?= $bulan . " " . $tahun ?></p>
            </li>
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">ID Pelanggan :</h5>
              <p class="mb-1"><?= $customer->id_pelanggan ?></p>
            </li>
            <li class="list-group-item  ">
              <h5 class="mb-1 fw-bold ">Nama : </h5>
              <p class="mb-1"><?= $customer->nama_pelanggan ?></p>
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