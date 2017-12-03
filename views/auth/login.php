<?php require ROOT . '/views/layouts/header.php'; ?>
	<div class="grid-body">
		<div class="login-block" >
			<div class="login-block-width">
				<img class="login-block-logo" src="/public/image/logo/logo_inpk_trading.svg">
				<form class="auth" action="/login/user" method="POST">
					<p class="error" style="display: none"></p>
					<div class="login-field-group">
		                <div class="login-notice"></div>
		            </div>
					<div class="login-field-group">
						<img src="/public/image/icon/login/user.png">
						<input type="text" name="login" placeholder="Логин" value="<?php isset($_SESSION['login']) ? print $_SESSION['login'] : '';  ?>">
					</div>
					<div class="login-field-group">
						<img src="/public/image/icon/login/password.png">
						<input type="password" name="password" placeholder="Пароль" value="<?php isset($_SESSION['password']) ? print $_SESSION['password'] : '';  ?>">
					</div>
					<button class="button button-color button-round button-login" type="submit" name="submit">Войти</button>
				</form>
			</div>
		</div>
	</div>
<?php require ROOT . '/views/layouts/footer.php'; ?>