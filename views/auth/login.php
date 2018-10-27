<?php require ROOT . '/views/layouts/header.php'; ?>
	<form class="form-signin auth" action="/login" method="POST">
		<div class="alert alert-danger" role="alert"></div>
		<label for="inputLogin" class="sr-only">Логин</label>
		<input type="login" id="inputLogin" class="form-control" placeholder="Логин" required="" autofocus="" value="<?php isset($_SESSION['login']) ? print $_SESSION['login'] : '';  ?>" name="login">
		<label for="inputPassword" class="sr-only">Пароль</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="" value="<?php isset($_SESSION['password']) ? print $_SESSION['password'] : '';  ?>" name="password">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
	</form>
<?php require ROOT . '/views/layouts/footer.php'; ?>