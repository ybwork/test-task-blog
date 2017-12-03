<!DOCTYPE html>
<html lang="ru">
  <head>
    <noscript>Для полной функциональности этого сайта необходимо включить JavaScript.</noscript>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auction</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:100,400,500,600&amp;subset=cyrillic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/public/plugins/select2/dist/css/select2.min.css">
    <link type="text/css" rel="stylesheet" href="/public/css/app.css.php?<?php print filemtime(ROOT . '/public/css/app.less'); ?>">
    <link type="text/css" rel="stylesheet" href="/public/plugins/datetimepicker/jquery.datetimepicker.css">
    <link type="text/css" rel="stylesheet" href="/public/plugins/fontawesome/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/public/plugins/datetimepicker/jquery.js"></script>
  </head>
    <header class="header">
      <div class="header-logo">
        <a href="/"><img src="/public/image/logo/logo_inpk_trading.svg"></a>
      </div>
      <div class="header-nav header-nav__mobile">
        <?php if ($_SESSION): ?>
          <?php if ($_SESSION['role'] == 1): ?>
            <a href="/admin/lots">Лоты</a>
            <a href="/admin/auctions">Аукционы</a>
            <a href="/admin/users">Пользователи</a>
          <?php endif; ?>
            <a href="/archive">Архив</a>
        <?php endif; ?>    
      </div>
      <?php if ($_SESSION): ?>
        <div class="header-user header-user--menu">
          <div class="user-name"><?php print $_SESSION['login']; ?></div>
          <div class="change-password">
            <img src="/public/image/icon/down-arrow.svg" />
          </div>
          <form id="changePassword" class="change-password-form common-ajax-form" action="/user/update" method="POST">
            <div class="password-error"></div>
            <div class="password-success"></div>
            <div class="change-password-input">
              <input type="hidden" name="id" value="<?php print $_SESSION['login']; ?>">
              <label>Старый пароль</label>
              <div class="change-password-form-input">
                <input type="password" name="old_password">
                <span class="eye-icon"></span>
              </div>
            </div>
            <div class="change-password-input">
              <label>Новый пароль</label>
              <div class="change-password-form-input">
                <input type="password" name="new_password">
                <span class="eye-icon"></span>
              </div>
            </div>
            <button type="submit" class="button button-color button-round button-change-password">Изменить пароль</button>
          </form>
        </div>
        <div class="header-logout">
          <a href="/logout"><img src="/public/image/icon/site/exit.svg"></a>
        </div>
      <?php else: ?>
        <div class="header-login">
          <a href="/login"><img src="/public/image/icon/site/login.svg"></a>
        </div>  
      <?php endif; ?>
    </header>
