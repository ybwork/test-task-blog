<?php

namespace controllers\site;

use \components\Validator;
use \implementing\validators\YBValidator;
use \components\Helper;
use \implementing\helpers\YBHelper;
use \components\Paginator;
use \implementing\paginators\YBPaginator;
use \models\site\Auction;
use \implementing\models\site\MySQLAuctionModel;
use \models\site\Bet;
use \implementing\models\site\MySQLBetModel;

class HomeController
{
	private $model;
	private $bet;
	private $helper;
	private $validator;
	private $paginator;

	/**
	 * Sets validator and access
	 */
	public function __construct()
	{
		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator);

		$this->helper = new Helper();
		$this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());

		$this->model = new Auction();
		$this->model->set_model(new MySQLAuctionModel());

		$this->bet = new Bet();
		$this->bet->set_model(new MySQLBetModel());
	}
	
	/**
	 * Shows home page system with all auctions
	 *
	 * @return html view
	 */
	public function index()
	{
        $limit = 3;
        $page = $this->helper->get_page();
        $offset = ($page - 1) * $limit;

        $count = $this->model->count();
        $total = $count[0]['COUNT(*)'];
        $index = '?page=';

        $this->paginator->set_params($total, $page, $limit, $index);

        $auctions = $this->model->get_all_by_offset_limit($offset, $limit);
        // var_dump($auctions); die();
		$bets = $this->bet->get_all();
		
		$transformed_bets = [];
		$i = 0;
		foreach ($bets as $bet) {
			$transformed_bets[$i][$bet['auction_id']]['bet'] = $bet['bet'];
			$transformed_bets[$i][$bet['auction_id']]['user_id'] = $bet['user_id'];
			$i++;
		}

		require_once(ROOT . '/views/site/home/index.php');
		return true;	
	}
}