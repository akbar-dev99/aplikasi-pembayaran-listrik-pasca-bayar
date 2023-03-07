<?php

$status_color = "danger"


?>

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
          <div class="col-md-12">
            <?php $this->load->view('layouts/flashdata'); ?>
          </div>
          <div class="col-md-7">
            <div class="card">
              <div class="card-header  pt-4 pb-0 ">
                <h3 class="  "><strong>NO. <?= $bill->id_tagihan ?></strong> </h3>
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
                    <td>
                      <?php if ($bill->status === "PAID") { ?>
                        <h5 class=" text-success fw-bolder     ">Lunas</h5>
                      <?php } elseif ($bill->status === "PROCESSED") { ?>
                        <h5 class=" text-warning fw-bolder     ">Menunggu Konfirmasi</h5>
                      <?php } else { ?>
                        <h5 class=" text-danger fw-bolder  ">Belum Lunas</h5>
                      <?php } ?>
                    </td>
                  </tr>
                  <tfoot>
                    <tr>
                      <td>
                        <h4 class=" fw-bold text-dark">Total</h4>
                      </td>
                      <td>
                        <h4 class=" fw-bold text-dark"><?= $total_pay ?></h4>
                      </td>
                    </tr>


                  </tfoot>
                </table>
              </div>

              <?php if ($bill->status === "UNPAID") : ?>
                <div class="card-footer pt-0 pb-4 d-grid gap-3 ">
                  <a href="<?= base_url('administrator/tagihan/' . $bill->id_tagihan . '/pembayaran') ?>" class="btn btn-primary px-4 py-2 ">Buat Pembayaran
                  </a>
                  <a href="<?= base_url("administrator/tagihan") ?>" class="btn btn-link text-primary ">Kembali</a>

                </div>
              <?php elseif ($bill->status === "PROCESSED") : ?>
                <div class="card-footer pt-0 pb-4 d-flex gap-3 justify-content-end ">
                  <div class="me-auto">
                    <a href="<?= base_url("administrator/tagihan") ?>" class="btn btn-link text-dark ">Kembali</a>
                  </div>
                  <div>
                    <button type="button" class="btn btn-danger  px-3 py-2 " data-bs-toggle="modal" data-bs-target="#rejectPay">
                      Tolak Pembayaran
                    </button>
                    <button type="button" class="btn btn-warning  px-3 py-2" data-bs-toggle="modal" data-bs-target="#confirmPay">
                      Setujui Pembayaran
                    </button>
                  </div>
                </div>
              <?php else : ?>
                <div class="card-footer pt-0 pb-4 d-grid gap-3 ">
                  <a href="<?= base_url("administrator/tagihan") ?>" class="btn btn-success w-100 px-4 py-2 me-auto ">Kembali</a>
                </div>
              <?php endif; ?>


            </div>
          </div>
        <?php endif; ?>
      <?php } ?>
    </div>
  </div>
</main>


<!-- Modal -->
<div class="modal fade" id="confirmPay" tabindex="-1" aria-labelledby="confirmPayLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0 ">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title text-center " id="confirmPayLabel">Anda yakin ingin menyetujui pembayaran dari Tagihan <strong><?= $bill->id_tagihan ?></strong> ?</h4>

        <form class="" action="<?= base_url('administrator/pembayaran/konfirmasi') ?>" method="post">
          <input type="hidden" name="id_tagihan" value="<?= $bill->id_tagihan ?>">
          <div class="pt-4 d-flex justify-content-end gap-2 ">
            <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">Tidak, Batalkan</button>
            <button type="submit" class="btn btn-warning px-3">Ya, Setuju</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="rejectPay" tabindex="-1" aria-labelledby="rejectPayLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0 ">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title text-center " id="rejectPayLabel">Anda yakink ingin menolak pembayaran dari Tagihan <strong><?= $bill->id_tagihan ?></strong>?</h4>

        <form class="" action="<?= base_url('administrator/pembayaran/tolak') ?>" method="post">
          <input type="hidden" name="id_tagihan" value="<?= $bill->id_tagihan ?>">
          <div class="pt-4 d-flex justify-content-end gap-2 ">
            <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">Tidak, Batalkan</button>
            <button type="submit" class="btn btn-danger px-3">Ya, Tolak</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>