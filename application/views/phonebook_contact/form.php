<h1><?= $heading ?></h1>
<hr>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <?= isset($input->ID) ? form_hidden('ID', $input->ID) : '' ?>

  <!-- GroupID / Group -->
  <div class="form-group has-feedback <?= setValidationStyle('GroupID') ?>">
    <?= form_label('Group', 'GroupID', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_dropdown('GroupID', getDropdownList('pbk_groups', ['ID', 'Name']), $input->GroupID, ['class' => 'form-control', 'autofocus' => 'autofocus']) ?>
      <?= setValidationIcon('GroupID') ?>
    </div>
    <?php if (form_error('GroupID')) : ?>
    <div class=" col-sm-5">
        <?= form_error('GroupID');?>
    </div>
    <?php endif ?>
  </div>

  <!-- Name / Nama orang -->
  <div class="form-group has-feedback <?= setValidationStyle('Name') ?>">
    <?= form_label('Nama', 'Name', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('Name', $input->Name, ['class' => 'form-control', 'placeholder' => 'Name']) ?>
      <?= setValidationIcon('Name') ?>
    </div>
    <?php if (form_error('Name')) : ?>
    <div class=" col-sm-5">
        <?= form_error('Name');?>
    </div>
    <?php endif ?>
  </div>

  <!-- Number / Nomor HP -->
  <div class="form-group has-feedback <?= setValidationStyle('Number') ?>">
    <?= form_label('Nomor HP', 'Number', ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_input('Number', $input->Number, ['class' => 'form-control', 'placeholder' => 'Nomor HP']) ?>
      <?= setValidationIcon('Number') ?>
    </div>
    <?php if (form_error('Number')) : ?>
    <div class=" col-sm-5">
        <?= form_error('Number');?>
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
