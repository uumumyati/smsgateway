<script>setInterval('autoRefresh()', 10000);</script>

<?php
  $perPage = 5;
  $page    = $this->uri->segment(2);
  $no      = isset($page) ? $page * $perPage - $perPage : 0;
?>

<h1><span class="glyphicon glyphicon-hourglass"></span> <?= $heading ?></h1>
<hr>

<?= showFlashMessage() ?>
<?= showMessage() ?>

<?php if ($outbox): ?>
<table class="table table-bordered table-condensed table-responsive">
  <thead>
    <tr>
      <th>No</th>
      <th>Tujuan</th>
      <th>Waktu</th>
      <th>Pesan</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($outbox as $row): ?>
    <tr>
      <td><?= ++$no ?></td>
      <td><?= $row->DestinationNumber ?></td>
      <td><?= $row->SendingDateTime ?></td>
      <td><?= $row->TextDecoded ?></td>
      <td>
        <?= form_open('outbox/delete') ?>
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
