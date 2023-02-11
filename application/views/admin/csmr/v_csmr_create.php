<?php

$nama_val = "";
$usr_val = "";
$no_kwh = "";
$alamat = "";
$tarif = "";

if ($this->session->flashdata('validation_err')) {
  $values = $this->session->flashdata('validation_err');
  $nama_val = $values['nama_pelanggan'];
  $usr_val = $values['username'];
  $no_kwh = $values['nomor_kwh'];
  $alamat = $values['alamat'];
  $tarif =  $values["id_tarif"];
}

?>



<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

      <!-- <div class="col-auto ms-auto text-end mt-n1">
        <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
        <a href="#" class="btn btn-primary">Tambah Pelanggan</a>
      </div> -->
    </div>

    <div class="row">
      <?= form_error() ?>
      <div class="col-md-12">
        <div class="text-center mb-2">
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            Kata sandi pelanggan akan dibuat otomatis. default kata sandinya yaitu <strong>PLGN123</strong>!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php $this->load->view('layouts/flashdata'); ?>
        </div>
        <div class="card">
          <div class="card-body ">
            <div class="m-sm-4">

              <form action="<?php echo base_url('administrator/pelanggan/tambah'); ?>" method="post">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="nama">Nama Lengkap:</label>
                      <input type="text" class="form-control form-control-lg " id="nama" name="nama" value="<?= $nama_val ?>">
                      <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="username">Nama pengguna / Username:</label>
                      <input type="text" class="form-control form-control-lg " id="username" name="username" value="<?= $usr_val ?>">
                      <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="nomor_kwh">Nomor KWH:</label>
                      <input type="text" class="form-control form-control-lg " id="nomor_kwh" name="nomor_kwh" value="<?= $no_kwh ?>">
                      <?= form_error('nomor_kwh', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="alamat">Alamat:</label>
                      <input type="text" class="form-control form-control-lg " id="alamat" name="alamat" value="<?= $alamat ?>">
                      <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="id_tarif">Pilih Tarif:</label>
                      <select class="form-select form-select-lg" aria-label="Default select example" name="id_tarif">
                        <option selected value="">Pilih Tarif Pelanggan</option>
                        <?php foreach ($tariffs as $tr) : ?>
                          <option value="<?= $tr["id_tarif"] ?>" <?php echo ($tarif == $tr["id_tarif"]) ? 'selected' : '' ?>><?= $tr["daya"] ?> ( <?= "Rp " . number_format($tr["tarif_perkwh"], 2, ",", "."); ?> )</option>
                        <?php endforeach; ?>

                      </select>
                      <?= form_error('id_tarif', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class=" d-flex gap-2  ">
                      <!-- <a href="index.html" class="btn btn-lg btn-primary">Daftar</a> -->
                      <a href="<?= base_url("administrator/pelanggan") ?>" class="btn btn-btn-outline-primary ">Batal</a>
                      <button type="submit" class="btn btn-lg btn-primary px-4 ">Simpan</button>
                    </div>
                  </div>
                </div>



              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>