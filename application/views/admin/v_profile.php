<!-- -->


<main class="content">
  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong>Profile</strong> </h3>
      </div>
      <div class="col-auto ms-auto text-end mt-n1">
        <!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
        <a href="<?php echo base_url('administrator/profile/ubah-password'); ?>" class="btn btn-primary"> <i data-feather="unlock" class="my-auto mb-1"></i> Ubah Passowrd</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php $this->load->view('layouts/flashdata'); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-12 ">
        <div class="card">
          <div class="card-header pb-0 pt-4">
            <h4 class=" card-title ">Detail Profil</h4>
          </div>
          <div class="card-body">
            <div class=" mx-3 mb-3 ">
              <form action="<?php echo base_url('administrator/profile/update'); ?>" method="post">
                <div class="form-group mb-3">
                  <label class="form-label" for="nama_admin">ID User :</label>
                  <input type="text" class="form-control form-control-lg " readonly id="nama_admin" value="<?= $user_auth->id_user ?>">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="nama_admin">Nama :</label>
                  <input type="text" class="form-control form-control-lg " id="nama_admin" name="nama_admin" value="<?= $user_auth->nama_admin ?>">
                  <?= form_error('nama_admin', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="username">Username:</label>
                  <input type="text" class="form-control form-control-lg " id="username" name="username" value="<?= $user_auth->username ?>">
                  <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="id_level">Level :</label>

                  <?php
                  $level = "PETUGAS";

                  if ($user_auth->level === "ADMIN") {
                    $level = "ADMIN";
                    if ($user_auth->id_user === "ADM0000") {
                      $level = "SUPERADMIN";
                    }
                  }

                  ?>
                  <input type="text" class="form-control form-control-lg " readonly id="id_level" value="<?= $level ?>">
                </div>

                <div class="row mt-4">

                  <div class="col-12 d-grid ">
                    <!-- <div class=" d-flex gap-2  "> -->
                    <button type="submit" class="btn btn-lg btn-primary px-4 ">Ubah Profile</button>
                    <!-- </div> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card">
          <div class="card-header pb-0 pt-4">
            <h4 class=" card-title ">Pembayaran Anda</h4>
          </div>
          <div class="card-body">
            <div class=" table-responsive ">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID Pembayaran</th>
                    <th>Pelanggan</th>
                    <th>Periode</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($user_pays as $p) {
                  ?>
                    <tr>
                      <td><?= $p->id_pembayaran ?></td>
                      <td>
                        <span><?= $p->id_pelanggan; ?></span>
                        <div class=" text-dark text-capitalize fw-bold  ">(<?= $p->nama_pelanggan ?>)</div>
                      </td>
                      <td class=" text-nowrap "><?= MonthToString($p->bulan) ?> <?= $p->tahun ?></td>
                      <td class=" text-nowrap "><?= Rupiah($p->total_bayar) ?></td>
                      <td><?= $p->tgl_bayar ?></td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>