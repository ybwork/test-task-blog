<?php

namespace controllers\site;

use \components\Validator;
use \implementing\validators\YBValidator;
use \components\Helper;
use \implementing\helpers\YBHelper;
use \models\site\Auction;
use \implementing\models\site\MySQLAuctionModel;
use \models\site\Bet;
use \implementing\models\site\MySQLBetModel;
use \models\site\Winner;
use \implementing\models\site\MySQLWinnerModel;

class AuctionController
{
	private $validator;
	private $helper;
	private $model;
	private $bet;
	private $winner;
	private $table_name;

	/**
	 * Sets validator, access, helper, model
	 */
	public function __construct()
	{
		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator());
		$this->validator->check_auth();

		$roles = ['admin', 'user'];
		$this->validator->check_access($roles);

		$this->helper = new Helper();
		$this->helper->set_helper(new YBHelper());

		$this->model = new Auction();
		$this->model->set_model(new MySQLAuctionModel());

		$this->bet = new Bet();
		$this->bet->set_model(new MySQLBetModel());

		$this->winner = new Winner();
		$this->winner->set_model(new MySQLWinnerModel());
	}

	/**
	 * Shows auction by id
	 * 
	 * @return html view
	 */
	public function show()
	{
		$id = (int) $this->helper->get_id();
		$auction = $this->model->show($id);

		if ($auction) {
			$date_time_start_stop_auction = $this->helper->transform_date_time($auction['start'], $auction['stop']);
		}

		$bets = $this->bet->get_all_by_auction_id($id);

		require_once(ROOT . '/views/site/auction/index.php');
		return true;
	}

	/**
	 * Checks auction by time end
	 *
	 * @param $auction_id - id auction
	 * @return true or false
	 */
	public function is_stop(int $auction_id)
	{
		$auction = $this->model->show($auction_id);
		
		if (count($auction) > 0) {
			date_default_timezone_set("Europe/Moscow");

			$current_time = date("Y-m-d H:i:s");
			$stop_time =  $auction['stop'];

			if ($current_time < $stop_time) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	/**
	 * Collects data for the end of the auction
	 *
	 * @return json and/or http headers with status code
	 */
	public function end()
	{
		$this->validator->check_request($_POST);

		$auction_id = (int) $_POST['auction_id'];

		if ($this->is_stop($auction_id)) {		
			$auction = $this->model->show($auction_id);
			if ($auction['bet'] && $auction['status'] == 1) {
				$data['auction_id'] = $auction_id;
				$data['user_id'] = (int) $auction['auctioneer'];
				$this->winner->create($data);
			}

			$this->model->change_status($auction_id, 3);
		} else {
			$response['message'] = 'Аукцион еще не закончился!';
			echo json_encode($response);
			return true;
		}
	}
}