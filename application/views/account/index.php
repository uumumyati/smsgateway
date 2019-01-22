<h1><?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>
<?= showMessage() ?>

<?php if($account): ?>
<div class="row">
  <div class="col-sm-4">
    <table class="table table-bordered table-condensed table-responsive">
      <tr>
        <th>Username</th>
        <td><?= $username ?></td>
      </tr>
      <tr>
        <th>Level</th>
        <td><?= $level ?></td>
      </tr>
    </table>
  </div>
</div>
<?php endif ?>

<hr>
<?= anchor('account/edit', 'Edit', ['class' => 'btn btn-primary', 'role' => 'button']) ?>