<?php

$nama_admin_val = "";
$usrnam_val = "";

$level = "";

if ($this->session->flashdata('validation_err')) {
  $values = $this->session->flashdata('validation_err');
  $nama_admin_val = $values['nama_admin'];
  $usrnam_val = $values['username'];
  $level =  $values["id_level"];
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
      <!-- <?= form_error() ?> -->
      <div class="col-sm-12">
        <div class="text-center mb-2">
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            Kata sandi pelanggan akan dibuat otomatis. default kata sandinya yaitu <strong>USER123!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php $this->load->view('layouts/flashdata'); ?>
        </div>
      </div>
      <div class="col-sm-10 col-md-6">

        <div class="card">
          <div class="card-body ">
            <div class="m-sm-4">
              <form action="<?php echo base_url('administrator/petugas/tambah'); ?>" method="post">
                <div class="form-group mb-3">
                  <label class="form-label" for="nama_admin">Nama :</label>
                  <input type="text" class="form-control form-control-lg " id="nama_admin" name="nama_admin" value="<?= $nama_admin_val ?>">
                  <?= form_error('nama_admin', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="username">Username:</label>
                  <input type="text" class="form-control form-control-lg " id="username" name="username" value="<?= $usrnam_val ?>">
                  <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="id_level">Pilih Tarif:</label>
                  <select class="form-select form-select-lg" aria-label="Default select example" name="id_level">
                    <option selected value="">Pilih Level</option>
                    <?php foreach ($roles as $role) : ?>
                      <option value="<?= $role["id_level"] ?>" <?php echo ($level == $role["id_level"]) ? 'selected' : '' ?>><?= $role["level"] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?= form_error('id_level', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="row">

                  <div class="col-12">
                    <div class=" d-flex gap-2  ">
                      <a href="<?= base_url("administrator/petugas") ?>" class="btn btn-btn-outline-primary ">Batal</a>
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