<?php

$nama_val = "";
$usr_val = "";
$no_kwh = "";
$alamat = "";
$tarif = "";

if ($this->session->flashdata('validation_err')) {
  $values = $this->session->flashdata('validation_err');
  $nama_val = $values['nama'];
  $usr_val = $values['username'];
  $no_kwh = $values['nomor_kwh'];
  $alamat = $values['alamat'];
  $tarif =  $values["id_tarif"];
}

?>


<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-10 col-lg-8 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">Pendaftaran Pelanggan</h1>
            <p class="lead">
              Mulailah membuat pengalaman pengguna terbaik.
            </p>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="m-sm-4">
                <div class="text-center">
                  <?php $this->load->view('layouts/flashdata'); ?>
                </div>
                <form action="<?php echo base_url('pelanggan/post-daftar'); ?>" method="post">
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
                        <label class="form-label" for="password">Kata Sandi:</label>
                        <input type="password" class="form-control form-control-lg " id="password" name="password">
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label" for="password">Ulangin Kata Sandi:</label>
                        <input type="password" class="form-control form-control-lg " id="password2" name="password2">
                        <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
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
                          <option selected value="">Pilih Tarif Anda</option>
                          <?php foreach ($tariffs as $tr) : ?>
                            <option value="<?= $tr["id_tarif"] ?>" <?php echo ($tarif == $tr["id_tarif"]) ? 'selected' : '' ?>><?= $tr["daya"] ?> ( <?= "Rp " . number_format($tr["tarif_perkwh"], 2, ",", "."); ?> )</option>
                          <?php endforeach; ?>
                          <!-- <?php foreach ($options as $key => $value) : ?>
                            <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                          <?php endforeach; ?> -->
                        </select>
                        <?= form_error('id_tarif', '<small class="text-danger">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="text-left mt-3">
                        <!-- <a href="index.html" class="btn btn-lg btn-primary">Daftar</a> -->
                        <button type="submit" class="btn btn-lg btn-primary px-4 ">Daftar</button>
                        <div class="mt-2">
                          <small>Atau kembali ke masuk? <a href="<?= base_url("/pelanggan/masuk") ?>">masuk</a></small>
                        </div>
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
  </div>
</main>