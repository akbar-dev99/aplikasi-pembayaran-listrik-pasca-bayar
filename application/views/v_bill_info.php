<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>
      <div class="col-auto ms-auto text-end mt-n1 gap-4 ">
        <!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
      </div>
    </div>

    <div class="row">
      <?php if ($error) { ?>
        <div class="col-12">
          <div class="alert alert-danger" role="alert">
            Data tagihan dengan ID <strong><?= $req_id ?></strong> tidak dapat ditemukan
          </div>
        </div>
      <?php } else { ?>

        <?php if ($bill) : ?>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header  pt-4 pb-0 ">
                <h3 class=" d-flex ">Tagihan <strong class="ms-auto"><?= $bill->id_tagihan ?></strong> </h3>
                <hr>
              </div>
              <div class="card-body pt-0 ">
                <table class="table  pt-0 mt-0">
                  <tr>
                    <td>
                      <h5>Nama Pelanggan</h5>
                    </td>
                    <td>
                      <h5 class=" text-capitalize "><?= $bill->nama_pelanggan ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Nomor KWH</h5>
                    </td>
                    <td>
                      <h5><?= $bill->nomor_kwh ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Periode</h5>
                    </td>
                    <td>
                      <h5><?= MonthToString($bill->bulan) ?> <?= $bill->tahun ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Jumlah Meter</h5>
                    </td>
                    <td>
                      <h5><?= $bill->jumlah_meter ?></h5>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h5>Total Tagihan</h5>
                    </td>
                    <td>
                      <h5><?= $total_bill ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Biaya Admin</h5>
                    </td>
                    <td>
                      <h5><?= $admin_fee ?></h5>
                    </td>
                  </tr>
                  </tr>
                  <tr>
                    <td>
                      <h5>Status</h5>
                    </td>
                    <td> <?php if ($bill->status === "PAID") { ?>
                        <h5 class=" text-success fw-bolder     ">Lunas</h5>
                      <?php } else { ?>
                        <h5 class=" text-danger fw-bolder  ">Belum Lunas</h5>
                      <?php } ?>
                    </td>
                  </tr>
                  <tfoot>
                    <tr>
                      <td>
                        <h4 class=" fw-bold text-primary">Total Pembayaran</h4>
                      </td>
                      <td>
                        <h4 class=" fw-bold text-primary "><?= $total_pay ?></h4>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        <?php endif; ?>
      <?php } ?>
    </div>
  </div>
</main>