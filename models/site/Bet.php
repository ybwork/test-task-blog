<?php

namespace models\site;

use \interfaces\models\site\IBetModel;

class Bet
{
	private $model;

    /**
     * Sets model
     *
     * @param IBetModel $model - object implementing interface IAuctionModel
     */
	public function set_model(IBetModel $model)
	{
		$this->model = $model;
	}

    /**
     * Gets all bets
     *
     * @return result of the function get_all
     */
	public function get_all()
	{
		return $this->model->get_all();
	}

	/**
	 * Gets all bets by auction
	 *
	 * @param $id - auction id
	 * @return result of function get_all_by_auction_id
	 */
	public function get_all_by_auction_id(int $id)
	{
		return $this->model->get_all_by_auction_id($id);
	}

    /**
     * Create auction
     *
     * @param $data - data from request
     * @return result of the function create
     */
	public function create(array $data)
	{
		return $this->model->create($data);
	}
}