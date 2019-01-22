<h1><span class="glyphicon glyphicon-list-alt"></span> <?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>
<?= showMessage() ?>

<?php if($phonebookGroup): ?>
<table class="table table-bordered table-condensed table-responsive">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Group</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 0 ?>
    <?php foreach($phonebookGroup as $row): ?>
    <tr>
      <td><?= ++$no ?></td>
      <td><?= $row->Name ?></td>
      <td><?= anchor("phonebook-group/edit/$row->ID", 'Edit', ['class' => 'btn btn-warning btn-xs', 'role' => 'button']) ?></td>
      <td>
        <?= form_open('phonebook-group/delete') ?>
        <?= form_hidden('ID', $row->ID) ?>
        <?= form_button([
          'type'         => 'submit',
          'content'      => 'Delete',
          'class'        => 'btn btn-danger btn-xs tombol-konfirmasi',
          'data-confirm' => 'Anda yakin akan menghapus group ini? Data kontak pada phonebook yang termasuk dalam group ini juga akan dihapus.'
        ]) ?>
        <?= form_close()?>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif ?>

<hr>
<?= anchor('phonebook-group/create', 'Create', ['class' => 'btn btn-primary', 'role' => 'button']) ?>