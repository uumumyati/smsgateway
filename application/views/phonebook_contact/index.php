<?php
  $perPage = 5;
  $page    = $this->uri->segment(2);
  $no      = isset($page) ? $page * $perPage - $perPage : 0;
?>

<h1><span class="glyphicon glyphicon-user"></span> <?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>
<?= showMessage() ?>

<?php if($phonebookContact): ?>
<table class="table table-bordered table-condensed table-responsive">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Nomor HP</th>
      <th>Group</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($phonebookContact as $row): ?>
    <tr>
      <td><?= ++$no ?></td>
      <td><?= $row->Name ?></td>
      <td><?= $row->Number ?></td>
      <td><?= $row->namaGroup ?></td>
      <td><?= anchor("phonebook-contact/edit/$row->ID", 'Edit', ['class' => 'btn btn-warning btn-xs', 'role' => 'button']) ?></td>
      <td>
        <?= form_open('phonebook-contact/delete') ?>
        <?= form_hidden('ID', $row->ID) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class'=> 'btn btn-danger btn-xs tombol-konfirmasi', 'data-confirm' => 'Anda yakin akan menghapus data ini?']) ?>
        <?= form_close()?>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

<p>Jumlah: <strong><?= $totalRow ?></strong></p>

<?php endif ?>

<?= $pagination ?>

<hr>
<?= anchor('phonebook-contact/create', 'Create', ['class' => 'btn btn-primary', 'role' => 'button']) ?>