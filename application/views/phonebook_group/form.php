<h1><?= $heading ?></h1>
<hr>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <?= isset($input->ID) ? form_hidden('ID', $input->ID) : '' ?>

  <!-- Name -->
  <div class="form-group has-feedback <?= setValidationStyle('Name') ?>">
    <?= form_label('Nama Group', 'Name', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('Name', $input->Name, ['class' => 'form-control', 'placeholder' => 'Name', 'autofocus' => 'autofocus']) ?>
      <?= setValidationIcon('Name') ?>
    </div>
    <?php if (form_error('Name')) : ?>
    <div class=" col-sm-5">
        <?= form_error('Name');?>
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
