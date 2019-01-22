<h1><span class="glyphicon glyphicon-user"></span> <?= $heading ?></h1>
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

  <!-- level -->
  <div class="form-group has-feedback <?= setValidationStyle('level')?>">
    <?= form_label('Level', 'level', ['class' => 'control-label col-sm-2']) ?>
    <div class="radio col-sm-5">
      <label>
        <?= form_radio('level', 'operator', (isset($input->level) && $input->level == 'operator') ? true : false) ?> Operator
      </label>
      <label>
        <?= form_radio('level', 'admin', (isset($input->level) && $input->level == 'admin') ? true : false) ?> Administrator
      </label>
    </div>
    <?php if (form_error('level')) : ?>
    <div class=" col-sm-5">
        <?= form_error('level');?>
    </div>
    <?php endif ?>
  </div>

  <!-- isBlokir -->
  <div class="form-group has-feedback <?= setValidationStyle('isBlokir')?>">
    <?= form_label('isBlokir?', 'isBlokir', ['class' => 'control-label col-sm-2']) ?>
    <div class="radio col-sm-5">
      <label>
        <?= form_radio('isBlokir', 'n', (isset($input->isBlokir) && $input->isBlokir == 'n') ? true : false) ?> Tidak
      </label>
      <label>
        <?= form_radio('isBlokir', 'y', (isset($input->isBlokir) && $input->isBlokir == 'y') ? true : false) ?> Ya (Pilih ini untuk memblokir)
      </label>
    </div>
    <?php if (form_error('isBlokir')) : ?>
    <div class=" col-sm-5">
        <?= form_error('isBlokir');?>
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
