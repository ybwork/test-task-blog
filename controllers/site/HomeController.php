<?php

namespace controllers\site;

use \components\ValidatorImp;
use \components\HelperImp;
use \components\PaginatorImp;

class HomeController
{
	private $model;
	private $bet;
	private $helper;
	private $validator;
	private $paginator;

	public function __construct()
	{
		$this->validator = new ValidatorImp();
		$this->helper = new HelperImp();
        $this->paginator = new PaginatorImp();
	}
	
	public function index()
	{   
		if (isset($_SESSION['login'])) {
			$view = '/views/site/home/home.php';
		} else {
			$view = '/views/auth/login.php';
		}

		require_once(ROOT . $view);
		return true;	
	}
}