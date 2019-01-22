<script>setInterval('autoRefresh()', 10000);</script>

<h1><span class="glyphicon glyphicon-stats"></span> <?= $heading ?></h1>
<hr>

<h3>Hasil Polling Sementara:</h3>
<?php if ($polling): ?>
<table class="table table-bordered table-condensed table-responsive">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Jumlah</th>
      <th>Prosentase</th>
      <th>Grafik</th>
      <th>Kode</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($polling as $row): ?>
    <tr>
      <td><?= $row->nama ?></td>
      <td><?= $row->voting ?></td>
      <td><?= $row->prosentase ?></td>
      <td><?= $row->grafik ?></td>
      <td><?= $row->kode ?></td>
    </tr>
    <?php endforeach ?>
    <tr>
      <td><strong>Jumlah Voting</strong></td>
      <td colspan="4"><?= $jumlahVoting ?></td>
    </tr>
  </tbody>
</table>
<?php endif ?>
<hr>
