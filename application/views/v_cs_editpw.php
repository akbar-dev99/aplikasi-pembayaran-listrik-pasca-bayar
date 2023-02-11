<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

      <div class="col-auto ms-auto text-end mt-n1">
        <!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
        <!-- <a href="#" class="btn btn-primary">???</a> -->
      </div>
    </div>
  </div>
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-md-6">
        <?php $this->load->view('layouts/flashdata'); ?>
        <div class="card pb-3">
          <div class="card-header">
            <h3 class="card-title">Ubah Password Anda</h3>
          </div>
          <div class="card-body">
            <form action="<?= base_url('pelanggan/profile/ubah-password') ?>" method="post">
              <div class="form-group mb-3">
                <label class="form-label" for="password_lama">Password Lama</label>
                <input type="password" class="form-control <?= form_error('password_lama') ? 'is-invalid' : '' ?>" id="password_lama" name="password_lama">
                <div class="invalid-feedback">
                  <?= form_error('password_lama') ?>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="password_baru">Password Baru</label>
                <input type="password" class="form-control <?= form_error('password_baru') ? 'is-invalid' : '' ?>" id="password_baru" name="password_baru">
                <div class="invalid-feedback">
                  <?= form_error('password_baru') ?>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" class="form-control <?= form_error('konfirmasi_password') ? 'is-invalid' : '' ?>" id="konfirmasi_password" name="konfirmasi_password">
                <div class="invalid-feedback">
                  <?= form_error('konfirmasi_password') ?>
                </div>
              </div>
              <div>
                <a href="<?= base_url("pelanggan/profile") ?>" class="btn btn-link btn-lg ">Batal</a>
                <button type="submit" class="btn btn-primary">Ubah Password</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>