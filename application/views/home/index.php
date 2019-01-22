<?= showFlashMessage() ?>
<?= showMessage() ?>

<div class="jumbotron">
  <h1>Selamat Datang!</h1>
  <?php if ($isLogin): ?>
    <p>Halo, <strong><?= $username ?>!</strong></p>
    <p>Selamat bekerja.</p>
  <?php else: ?>
    <p>Selamat datang di aplikasi CISMS v3.0.6.</p>
    <p>Untuk menggunakan aplikasi ini silakan login dahulu.</p>
    <p><?= anchor('login', 'Login', ['class' => 'btn btn-primary', 'role' => 'button']) ?></p>
  <?php endif ?>
</div>
