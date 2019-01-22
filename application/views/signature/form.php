<h1><span class="glyphicon glyphicon-pencil"></span> <?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>

<?= form_open($formAction, ['class' => 'form-horizontal', 'role' => 'form']) ?>
  <!-- message -->
  <div class="form-group has-feedback <?= setValidationStyle('message') ?>">
    <?= form_label('Signature', null, ['class' => 'control-label col-sm-2']) ?>
    <div class="col-sm-5">
      <?= form_textarea('message', $input->message, ['class' => 'form-control', 'placeholder' => 'Signature']) ?>
      <?= setValidationIcon('message') ?>
    </div>
    <?php if (form_error('message')) : ?>
    <div class=" col-sm-5">
        <?= form_error('message');?>
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
