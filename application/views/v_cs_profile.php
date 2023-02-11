<?php

$name_val = $profile->nama_pelanggan;
$usr_val = $profile->username;
$no_kwh = $profile->nomor_kwh;
$address = $profile->alamat;
$tarif =  $profile->id_tarif;
$id_cus =  $profile->id_pelanggan;
?>

<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

      <div class="col-auto ms-auto text-end mt-n1">
        <a href="<?php echo base_url('pelanggan/profile/ubah-password'); ?>" class="btn btn-primary"> <i data-feather="unlock" class="my-auto mb-1"></i> Ubah Passowrd</a>
      </div>
    </div>

    <div class="row">
      <?= form_error() ?>
      <div class="col-md-12">
        <div class="text-center mb-2">

          <?php $this->load->view('layouts/flashdata'); ?>
        </div>
        <div class="card">
          <div class="card-body ">
            <div class="m-sm-4">

              <form action="<?php echo base_url('pelanggan/profile'); ?>" method="post">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="id_pelanggan">ID Pelanggan:</label>
                      <input type="text" class="form-control form-control-lg " id="id_pelanggan" readonly value="<?= $id_cus ?>">
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
                      <label class="form-label" for="nama">Nama Lengkap:</label>
                      <input type="text" class="form-control form-control-lg " id="nama" name="nama" value="<?= $name_val ?>">
                      <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label" for="alamat">Alamat:</label>
                      <input type="text" class="form-control form-control-lg " id="alamat" name="alamat" value="<?= $address ?>">
                      <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
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
                  <div class="col-12 col-md-6 mb-2">
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

                  <div class="col-12 mt-3">
                    <div class=" d-flex gap-2  ">
                      <!-- <a href="index.html" class="btn btn-lg btn-primary">Daftar</a> -->

                      <button type="submit" class="btn btn-lg btn-primary px-4 ">Ubah profil</button>
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