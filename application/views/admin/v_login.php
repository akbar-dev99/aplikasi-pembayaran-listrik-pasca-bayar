<?php

$id_user = "";
$password = "";

if ($this->session->flashdata('form_values')) {
  $values = $this->session->flashdata('form_values');
  $id_user = $values['id_user'];
  $password = $values['password'];
}

?>

<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">Selamat Datang di Administrator ListrikKu</h1>
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
                <form action="<?php echo base_url('administrator/post-masuk'); ?>" method="post">
                  <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input class="form-control form-control-lg" type="text" name="id_user" placeholder="Masukan ID anda" value="<?= $id_user ?>">
                    <?= form_error('id_user', '<small class="text-danger">', '</small>'); ?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Masuk kata sandi anda" value="<?= $password ?>" />
                    <?= form_error('password', '<small class="text-danger">', '</small> <br>'); ?>
                    <small>
                      <a href="<?= base_url("administrator/lupa-sandi") ?>">Forgot password?</a>
                    </small>
                  </div>
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Masuk</button>

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