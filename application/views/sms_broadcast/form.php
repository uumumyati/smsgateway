<h1><span class="glyphicon glyphicon-volume-up"></span> <?= $heading ?></h1>
<hr>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <?= isset($input->ID) ? form_hidden('ID', $input->ID) : '' ?>

  <!-- DestinationNumbers -->
  <div class="form-group has-feedback <?= setValidationStyle('DestinationNumbers') ?>">
    <?= form_label('No HP', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_textarea('DestinationNumbers', $input->DestinationNumbers, ['class' => 'form-control', 'placeholder' => 'Daftar nomor tujuan, pisahkan dengan Enter']) ?>
      <?= setValidationIcon('DestinationNumbers') ?>
    </div>
    <?php if (form_error('DestinationNumbers')) : ?>
    <div class=" col-sm-5">
        <?= form_error('DestinationNumbers');?>
    </div>
    <?php endif ?>
  </div>

  <!-- TextDecoded -->
  <div class="form-group has-feedback <?= setValidationStyle('TextDecoded') ?>">
    <?= form_label('Isi SMS', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_textarea('TextDecoded', $input->TextDecoded, ['class' => 'form-control', 'placeholder' => 'Isi SMS']) ?>
      <?= setValidationIcon('TextDecoded') ?>
    </div>
    <?php if (form_error('TextDecoded')) : ?>
    <div class=" col-sm-5">
        <?= form_error('TextDecoded');?>
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
