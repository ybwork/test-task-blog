<?php

namespace controllers\site;

use \components\Validator;
use \implementing\validators\YBValidator;
use \models\site\Bet;
use \implementing\models\site\MySQLBetModel;
use \models\site\Auction;
use \implementing\models\site\MySQLAuctionModel;

class BetController
{
	private $validator;
	private $model;
	private $auction;

	/**
	 * Sets validator, helper, paginator, model, access
	 */
	public function __construct()
	{
		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator());
		$this->validator->check_auth();

		$roles = ['admin', 'user'];
		$this->validator->check_access($roles);

		$this->model = new Bet();
		$this->model->set_model(new MySQLBetModel());

		$this->auction = new Auction();
		$this->auction->set_model(new MySQLAuctionModel());
	}

	/**
	 * Checks user bet
	 *
	 * @param $auction_id - id selected auction
	 * @param $user_id - user id which did bet
	 * @param $current_bet - current bet
	 * @return json and http headers with status code
	 */
	public function check(int $auction_id, int $user_id, int $current_bet)
	{
		$auction = $this->auction->show($auction_id);

		$start_bet = (int) $auction['price'];
		$last_bet = (int) $auction['bet'];
		$auctioneer = (int) $auction['auctioneer'];

		if ($user_id == $auctioneer) {
			header('HTTP/1.0 400 Bad Request', http_response_code(400));

			$response['message'] = 'Вы уже сделали ставку';

			echo json_encode($response);
			die();
		} elseif ($current_bet <= $last_bet && count($last_bet) > 0) {
			header('HTTP/1.0 400 Bad Request', http_response_code(400));

			$response['message'] = 'Ставка не может быть меньше или равной текущей';

			echo json_encode($response);
			die();
		}
	}

    /**
     * Collects data for create bet
     *
     * @return result in json and/or http headers with status code
     */
	public function create()
	{
		$this->validator->check_request($_POST);

		$data['auction_id'] = (int) $_POST['auction_id'];
		$data['user_id'] = (int) $_SESSION['id'];
		$data['bet'] = (int) $_POST['bet'];

		$this->check($data['auction_id'], $data['user_id'], $data['bet']);
		$this->model->create($data);
	}
}