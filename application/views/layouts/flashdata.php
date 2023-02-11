<?php if ($this->session->flashdata('message_error')) : ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('message_error');  ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('message_info')) : ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('message_info');  ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('message_success')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('message_success');  ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>


<?php if ($this->session->flashdata('message_warning')) : ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('message_warning');  ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>