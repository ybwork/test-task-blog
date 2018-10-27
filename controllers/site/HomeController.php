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
        // $limit = 3;
        // $page = $this->helper->get_page();
        // $offset = ($page - 1) * $limit;

        // $count = $this->model->count();
        // $total = $count[0]['COUNT(*)'];
        // $index = '?page=';

        // $this->paginator->set_params($total, $page, $limit, $index);
        // $auctions = $this->model->get_all_by_offset_limit($offset, $limit);
        
		if (isset($_SESSION['login'])) {
			$view = '/views/site/home/home.php';
		} else {
			$view = '/views/auth/login.php';
		}

		require_once(ROOT . $view);
		return true;	
	}
}