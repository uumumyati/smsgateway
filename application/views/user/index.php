<?php  $no = 0; ?>

<h1><span class="glyphicon glyphicon-user"></span> <?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>
<?= showMessage() ?>

<?php if($user): ?>
<table class="table table-bordered table-condensed table-responsive">
  <thead>
    <tr>
      <th>No</th>
      <th>Username</th>
      <th>Level</th>
      <th>Blokir?</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($user as $row): ?>
    <tr>
      <td><?= ++$no ?></td>
      <td><?= $row->username ?></td>
      <td><?= $row->level ?></td>
      <td><?= $row->isBlokir ?></td>
      <td><?= anchor("user/edit/$row->ID", 'Edit', ['class' => 'btn btn-warning btn-xs', 'role' => 'button']) ?></td>
      <td>
        <?= form_open('user/delete') ?>
        <?= form_hidden('ID', $row->ID) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class'=> 'btn btn-danger btn-xs tombol-konfirmasi', 'data-confirm' => 'Anda yakin akan menghapus data ini?']) ?>
        <?= form_close()?>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif ?>

<hr>
<?= anchor('user/create', 'Create', ['class' => 'btn btn-primary', 'role' => 'button']) ?>