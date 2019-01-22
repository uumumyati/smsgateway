<h1><?= $heading ?></h1>
<hr>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <?= isset($input->ID) ? form_hidden('ID', $input->ID) : '' ?>

  <!-- username -->
  <div class="form-group has-feedback <?= setValidationStyle('username') ?>">
    <?= form_label('Username', 'username', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('username', $input->username, ['class' => 'form-control', 'placeholder' => 'Username']) ?>
      <?= setValidationIcon('username') ?>
    </div>
    <?php if (form_error('username')) : ?>
    <div class=" col-sm-5">
        <?= form_error('username');?>
    </div>
    <?php endif ?>
  </div>

  <!-- password -->
  <div class="form-group has-feedback <?= setValidationStyle('password') ?>">
    <?= form_label('Password', 'password', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_password('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) ?>
      <?= setValidationIcon('password') ?>
    </div>
    <?php if (form_error('password')) : ?>
    <div class=" col-sm-5">
        <?= form_error('password');?>
    </div>
    <?php endif ?>
  </div>

  <!-- passConf -->
  <div class="form-group has-feedback <?= setValidationStyle('passConf') ?>">
    <?= form_label('Konfirmasi Password', 'passConf', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_password('passConf', null, ['class' => 'form-control', 'placeholder' => 'Konfirmasi Password']) ?>
      <?= setValidationIcon('passConf') ?>
    </div>
    <?php if (form_error('passConf')) : ?>
    <div class=" col-sm-5">
        <?= form_error('passConf');?>
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
