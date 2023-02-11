<?php

$usr_val = "";
$password = "";

if ($this->session->flashdata('validation_err')) {
  $values = $this->session->flashdata('validation_err');
  $usr_val = $values['username'];
  $password = $values['password'];
}

?>

<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">Selamat Datang kembali</h1>
            <p class="lead">
              Masuk ke akun Anda untuk melanjutkan
            </p>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="m-sm-4">
                <div class="text-center">
                  <?php $this->load->view('layouts/flashdata'); ?>
                </div>
                <form action="<?php echo base_url('pelanggan/post-masuk'); ?>" method="post">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukan username anda" value="<?= $usr_val ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Masuk kata sandi anda" value="<?= $password ?>" />
                    <?= form_error('password', '<small class="text-danger">', '</small> <br>'); ?>
                    <small>
                      <a href="<?= base_url("pelanggan/lupa-sandi") ?>">Forgot password?</a>
                    </small>
                  </div>

                  <div>
                    <label class="form-check">
                      <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                      <span class="form-check-label">
                        Remember me next time
                      </span>
                    </label>
                  </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Masuk</button>
                    <div class="mt-2">
                      <small>Belum terdaftar? <a href="<?= base_url("/pelanggan/daftar") ?>">daftar sekarang</a></small>
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