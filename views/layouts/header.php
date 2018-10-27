<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="public/css/signin.css" rel="stylesheet">
    <link href="public/css/app.css" rel="stylesheet">
  </head>
  <body class="bg-light grid-body">
    <?php if ($_SESSION): ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/admin/articles">Статьи</a>
            </li>
          </ul>
          <div>
            <a href="/logout">Выйти</a>
          </div>
      </nav>
    <?php endif; ?>