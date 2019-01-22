<nav class="navbar navbar-inverse navbar-default navbar-static-top">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= anchor(base_url(), 'CISMS306', ['class' => 'navbar-brand']) ?>
    </div>

    <div id="navbar" class="navbar-collapse collapse">
      <?php if ($isLogin): ?>
      <ul class="nav navbar-nav">
        <!-- Phonebook -->
        <li class="dropdown">
          <?= anchor('#', '<span class="glyphicon glyphicon-book"></span> Phonebook <span class="caret"></span>', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']) ?>
          <ul class="dropdown-menu">
            <li><?= anchor('phonebook-group', '<span class="glyphicon glyphicon-list-alt"></span> Phonebook Group') ?></li>
            <li><?= anchor('phonebook-contact', '<span class="glyphicon glyphicon-user"></span> Phonebook Contact') ?></li>
          </ul>
        </li>

        <!-- SMS -->
        <li class="dropdown">
          <?= anchor('#', '<span class="glyphicon glyphicon-envelope"></span> SMS <span class="caret"></span>', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']) ?>
          <ul class="dropdown-menu">
            <li><?= anchor('inbox', '<span class="glyphicon glyphicon-save"></span> Inbox') ?></li>
            <li><?= anchor('outbox', '<span class="glyphicon glyphicon-hourglass"></span> Outbox') ?></li>
            <li><?= anchor('sent', '<span class="glyphicon glyphicon-check"></span> Sent') ?></li>
            <li role="separator" class="divider"></li>
            <li><?= anchor('sms/create', '<span class="glyphicon glyphicon-file"></span> SMS') ?></li>
            <li><?= anchor('signature', '<span class="glyphicon glyphicon-pencil"></span> Signature') ?></li>
            <li><?= anchor('sms-signature/create', '<span class="glyphicon glyphicon-thumbs-up"></span> SMS with Signature') ?></li>
            <li><?= anchor('sms-flash/create', '<span class="glyphicon glyphicon-flash"></span> Flash SMS') ?></li>
            <li><?= anchor('sms-group/create', '<span class="glyphicon glyphicon-duplicate"></span> Group SMS') ?></li>
            <li><?= anchor('sms-broadcast/create', '<span class="glyphicon glyphicon-volume-up"></span> Broadcast SMS') ?></li>
            <li><?= anchor('sms-scheduled', '<span class="glyphicon glyphicon-time"></span> Scheduled SMS') ?></li>
            <li role="separator" class="divider"></li>
            <li><?= anchor('autoreply', '<span class="glyphicon glyphicon-retweet"></span> Auto-Reply') ?></li>
            <li><?= anchor('polling', '<span class="glyphicon glyphicon-stats"></span> Polling') ?></li>
          </ul>
        </li>

        <!-- User -->
        <?php if ($isLogin && ($level == 'admin')): ?>
        <li><?= anchor('user', 'User') ?></li>
        <?php endif ?>

      </ul> <!-- nav navbar-nav -->
      <?php endif ?> <!-- isLogin -->

      <!-- Account info and login / logout link -->
      <ul class="nav navbar-nav navbar-right">
        <?php if ($isLogin): ?>
        <li><?= anchor('account', 'Account') ?></li>
        <li><?= anchor('logout', "[ $username ]", ['class' => 'tombol-konfirmasi', 'data-confirm' => 'Anda yakin akan logout?']) ?></li>
        <?php else: ?>
        <li><?= anchor('login', 'Login') ?></li>
        <?php endif ?>
      </ul>

    </div> <!-- #navbar -->
  </div> <!-- .container -->
</nav>
