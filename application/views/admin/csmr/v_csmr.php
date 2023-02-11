<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

      <div class="col-auto ms-auto text-end mt-n1">
        <a href="<?= base_url("administrator/pelanggan/tambah") ?>" class="btn btn-primary">Tambah Pelanggan</a>
      </div>
    </div>

    <div class="row">

      <div class="col-md-12">
        <?php $this->load->view('layouts/flashdata'); ?>

        <div class="card">
          <div class="card-body ">
            <div class=" table-responsive ">
              <table class="table table-bordered ">
                <thead class="thead-light">
                  <tr>
                    <th>ID Pelanggan</th>
                    <th class=" text-nowrap ">Nama Pelanggan</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>Nomor KWH</th>
                    <th>Daya</th>
                    <th>Tarif Per KWH</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($customers as $c) : ?>
                    <tr>
                      <td><?php echo $c->id_pelanggan ?></td>
                      <td class=" text-nowrap "><?php echo $c->nama_pelanggan ?></td>
                      <td><?php echo $c->username ?></td>
                      <td><?php echo $c->alamat ?></td>
                      <td><?php echo $c->nomor_kwh ?></td>
                      <td><?php echo $c->daya ?></td>
                      <td class=" text-nowrap "><?php echo Rupiah($c->tarif_perkwh) ?></td>
                      <td>
                        <div class="d-flex gap-2">
                          <a href="<?php echo site_url('administrator/pelanggan/ubah/' . $c->id_pelanggan) ?>" class="btn btn-primary btn-sm ">Edit</a>
                          <a href="<?php echo site_url('administrator/pelanggan/hapus/' . $c->id_pelanggan) ?>" class="btn btn-danger btn-sm">Hapus</a>
                          <!-- <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle text-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              Lainnya
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="<?= base_url("administrator/penggunaan/input/" . $c->id_pelanggan) ?>">Input Penggunaan</a></li>

                            </ul>
                          </div> -->
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>