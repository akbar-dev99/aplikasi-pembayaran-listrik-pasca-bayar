<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php $this->load->view('layouts/flashdata'); ?>
        <div class="card">
          <div class="card-body">
            <div class=" table-responsive ">
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Periode</th>
                    <th>Biaya Admin</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($pays as $p) {
                  ?>
                    <tr>
                      <td><?= $p->id_pembayaran ?></td>
                      <td>
                        <span><?= $p->id_pelanggan; ?></span>
                        <div class=" text-dark text-capitalize fw-bold  ">(<?= $p->nama_pelanggan ?>)</div>
                      </td>
                      <td class=" text-nowrap "><?= Rupiah($p->bulan) ?> <?= $p->tahun ?></td>
                      <td class=" text-nowrap "><?= Rupiah($p->biaya_admin) ?></td>
                      <td class=" text-nowrap "><?= Rupiah($p->total_bayar) ?></td>
                      <td><?= $p->tgl_bayar ?></td>
                      <td class=" text-capitalize "><?= $p->nama_admin  ?> </td>

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