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
      <?php if ($_SESSION): ?>
        <div class="header-logo">
          <a href="/"><img src="">Home</a>
        </div>
        <div class="header-nav header-nav__mobile">   
        </div>
        <div class="header-user header-user--menu">
          <div class="user-name"><?php print $_SESSION['login']; ?></div>
          <div class="header-logout">
            <a href="/logout">Sing out</a>
          </div>
        </div>
      <?php endif; ?>
    </header>
