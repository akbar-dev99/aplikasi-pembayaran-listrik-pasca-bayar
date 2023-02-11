<main class="content">

  <div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
        <h3><strong><?= $title ?></strong></h3>
      </div>

    </div>

    <div class="row ">
      <div class="col-12 col-md-8 col-lg-6">
        <div class=" py-2">
          <?php $this->load->view('layouts/flashdata'); ?>
        </div>
        <div class="card card-body shadow-none border ">
          <form class=" g-3" action="<?= base_url("administrator/tarif/post-update/" . $tariff->id_tarif) ?>" method="post">
            <div class="form-group mb-3">
              <label for="daya" class="form-label">Daya</label>
              <input type="text" class="form-control form-control-lg" id="daya" name="daya" placeholder="Daya" value="<?= $tariff->daya ?>">
              <?= form_error('daya', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group mb-3">
              <label for="tarif_perkwh" class="form-label">Tarif per-KWH</label>
              <input type="text" class="form-control form-control-lg" id="tarif_perkwh" name="tarif_perkwh" placeholder="Tarif perkwh" value="<?= $tariff->tarif_perkwh ?>">
              <?= form_error('tarif_perkwh', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group d-flex gap-2">
              <a href="<?= base_url("administrator/tarif") ?>" class="btn btn-btn-outline-primary mb-3">Batal</a>
              <button type="submit" class="btn btn-primary mb-3">Simpan</button>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>
</main>