<?php

use \components\RouterImp;
	
// Config
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Connect files
define('ROOT', __DIR__);

require_once(ROOT . '/components/RouterImp.php');
require_once(ROOT . '/components/Autoload.php');

// var_dump(password_hash('zxcvzxcv', PASSWORD_DEFAULT)); die();
// Start router
$router = new RouterImp();
$router->run();
