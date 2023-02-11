<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

      <div class="col-auto ms-auto text-end mt-n1">
        <!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
        <a href="<?= base_url("administrator/petugas/tambah") ?>" class="btn btn-primary">Tambah Petugas</a>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <?php $this->load->view('layouts/flashdata'); ?>
    </div>
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Admin</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) : ?>
                <?php if ($logged_in_user_id != $user->id_user) : ?>
                  <tr class="  ">
                    <td><?php echo $user->id_user; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->nama_admin; ?></td>
                    <td>
                      <?php if ($user->level === "ADMIN") { ?>
                        <?php if ($user->id_user === "ADM0000") : ?>
                          <span class=" badge bg-dark rounded-0 px-2  fw-normal py-2  ">SUPERADMIN</span>
                        <?php else : ?>
                          <span class=" badge bg-secondary rounded-0 px-2  fw-normal py-2  "><?php echo $user->level; ?></span>
                        <?php endif; ?>
                      <?php } else if ($user->level === "PETUGAS") { ?>
                        <span class=" badge bg-primary rounded-0 px-2  fw-normal py-2 "><?php echo $user->level; ?></span>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($user->id_user !== "ADM0000") : ?>
                        <div class=" d-flex gap-2 justify-content-center ">
                          <a class="btn btn-primary btn-sm rounded-0 " href="<?php echo site_url('administrator/petugas/ubah/' . $user->id_user); ?>">Edit</a>
                          <a class="btn btn-danger  btn-sm rounded-0" href="<?php echo site_url('administrator/petugas/delete/' . $user->id_user); ?>">Delete</a>
                        </div>
                      <?php endif; ?>

                    </td>
                  </tr>
                <?php else : ?>
                  <tr class=" bg-light">
                    <td><?php echo $user->id_user; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->nama_admin; ?></td>
                    <td>
                      <?php if ($user->level === "ADMIN") { ?>
                        <?php if ($user->id_user === "ADM0000") : ?>
                          <span class=" badge bg-dark rounded-0 px-2  fw-normal py-2  ">SUPERADMIN</span>
                        <?php else : ?>
                          <span class=" badge bg-secondary rounded-0 px-2  fw-normal py-2  "><?php echo $user->level; ?></span>
                        <?php endif; ?>
                      <?php } else if ($user->level === "PETUGAS") { ?>
                        <span class=" badge bg-primary rounded-0 px-2  fw-normal py-2 "><?php echo $user->level; ?></span>
                      <?php } ?>
                    </td>
                    <td>
                    </td>
                  </tr>
                <?php endif; ?>

              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</main>