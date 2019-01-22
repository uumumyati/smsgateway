<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CICMS v3.0.6</title>
  <link href="<?= base_url('asset/bootstrap_3_3_6/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('asset/css/style.css') ?>" rel="stylesheet">
  <link href="<?= base_url('asset/jquery_ui_1_12_0/jquery-ui.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('asset/timepicker_1_6_3/jquery-ui-timepicker-addon.css') ?>" rel="stylesheet">
</head>

<body>
  <?php $this->load->view('navbar') ?>

  <div class="container">
    <?php $this->load->view($mainView) ?>
  </div>

  <?php $this->load->view('footer') ?>

  <!--[if lt IE 9]>
  <script src="<?= base_url('asset/js/html5shiv_3_7_2/html5shiv.min.js') ?>"></script>
  <script src="<?= base_url('asset/js/respond_1_4_2/respond.min.js') ?>"></script>
  <![endif]-->
  <script src="<?= base_url('asset/js/jquery-1.12.4.min.js') ?>"></script>
  <script src="<?= base_url('asset/jquery_ui_1_12_0/jquery-ui.min.js') ?>"></script>
  <script src="<?= base_url('asset/timepicker_1_6_3/jquery-ui-timepicker-addon.js') ?>"></script>
  <script src="<?= base_url('asset/bootstrap_3_3_6/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('asset/js/app.js') ?>"></script>
</body>

</html>
