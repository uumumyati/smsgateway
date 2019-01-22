<h1><span class="glyphicon glyphicon-thumbs-up"></span> <?= $heading ?></h1>
<hr>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <?= isset($input->ID) ? form_hidden('ID', $input->ID) : '' ?>

  <!-- no_hp -->
  <div class="form-group has-feedback <?= setValidationStyle('no_hp') ?>">
    <?= form_label('No HP Tujuan', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('no_hp', $input->no_hp, ['class' => 'form-control', 'placeholder' => 'No HP Tujuan', 'autofocus' => 'autofocus']) ?>
      <?= setValidationIcon('no_hp') ?>
    </div>
    <?php if (form_error('no_hp')) : ?>
    <div class=" col-sm-5">
        <?= form_error('no_hp');?>
    </div>
    <?php endif ?>
  </div>

  <!-- waktu -->
  <div class="form-group has-feedback <?= setValidationStyle('waktu') ?>">
    <?= form_label('Waktu', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('waktu', $input->waktu, ['class' => 'form-control waktu', 'placeholder' => 'yyyy-mm-dd hh:mm']) ?>
      <?= setValidationIcon('waktu') ?>
    </div>
    <?php if (form_error('waktu')) : ?>
    <div class=" col-sm-5">
      <?= form_error('waktu');?>
    </div>
    <?php endif ?>
  </div>

  <!-- pesan -->
  <div class="form-group has-feedback <?= setValidationStyle('pesan') ?>">
    <?= form_label('Isi SMS', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_textarea('pesan', $input->pesan, ['class' => 'form-control', 'placeholder' => 'Isi SMS']) ?>
      <?= setValidationIcon('pesan') ?>
    </div>
    <?php if (form_error('pesan')) : ?>
    <div class=" col-sm-5">
      <?= form_error('pesan');?>
    </div>
    <?php endif ?>
  </div>

  <hr>
  <!-- Submit -->
  <div class="form-group">
    <div class="col-sm-2 col-sm-offset-2">
      <?= form_button(['type' => 'submit', 'content' => $buttonText, 'class' => 'btn btn-primary']) ?>
    </div>
  </div>

<?= form_close() ?>
