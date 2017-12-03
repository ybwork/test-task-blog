<?php

namespace implementing\models\site;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\site\IAuctionModel;
use \implementing\models\YBModel;

class MySQLAuctionModel implements IAuctionModel
{
	public $db_connection;
	public $validator;
	public $table_name;

	/**
	 * Sets validator, connection with db, data for work with base model
	 */
	public function __construct()
	{
		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator());

		$this->db_connection = new DBConnection();
		$this->db_connection->set_connection(new MySQLConnection);

        $this->table_name = 'auctions';
	}

	/**
	 * Gets all auction from db
	 *
	 * @return array data or status code
	 */
	public function get_all()
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, a.status, l.name, l.description, l.price FROM auctions a JOIN lots l ON a.lot_id = l.id WHERE a.status = :status ORDER BY a.id DESC';

		$query = $db->prepare($sql);

		$query->bindValue(':status', 1, \PDO::PARAM_INT);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}

	/**
	 * Gets all auctions from db by offset/limit
	 *
	 * @param $offset - place for start
	 * @param $limit - record number limit
	 * @return array data or status code
	 */
	public function get_all_by_offset_limit(int $offset, int $limit)
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, a.status, l.name, l.description, l.price FROM auctions a JOIN lots l ON a.lot_id = l.id WHERE a.status = :status ORDER BY a.id DESC LIMIT :offset, :limit';

		$query = $db->prepare($sql);

		$query->bindValue(':status', 1, \PDO::PARAM_INT);
		$query->bindValue(':offset', $offset, \PDO::PARAM_INT);
		$query->bindValue(':limit', $limit, \PDO::PARAM_INT);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}

	/**
	 * Gets data from db
	 * 
	 * @param $id - auction id
	 * @return array data or status code
	 */
	public function show(int $id)
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, a.status, l.id as lot_id, l.name, l.description, l.price, b.bet, b.user_id as auctioneer FROM auctions a JOIN lots l ON a.lot_id = l.id LEFT JOIN bets b ON a.id = b.auction_id WHERE a.id = :id ORDER BY b.id DESC LIMIT 1';

		$query = $db->prepare($sql);

		$query->bindValue(':id', $id);

		if ($query->execute()) {
			return $query->fetch(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}

	/**
	 * Changes status auction
	 *
	 * @param $id - auction id
	 * @param $status - auction status
	 * @return json and/or http headers with status code
	 */
	public function change_status(int $id, int $status)
	{
		$db = $this->db_connection->get_connection();

		$sql = 'UPDATE auctions SET status = :status WHERE id = :id';

		$query = $db->prepare($sql);

		$query->bindValue(':id', $id, \PDO::PARAM_INT);
		$query->bindValue(':status', $status, \PDO::PARAM_INT);

		if ($query->execute()) {
			$response['message'] = 'Готово';
			echo json_encode($response);
			return true;
		} else {
			http_response_code(500);
			$this->validator->check_response('ajax');
		}
	}

	/**
	 * Counts data to db
	 * 
	 * @return array data or status code
	 */
	public function count()
	{
		$db = $this->db_connection->get_connection();
		
		$sql = 'SELECT COUNT(*) FROM auctions WHERE status = :status';

		$query = $db->prepare($sql);

		$query->bindValue(':status', 1, \PDO::PARAM_INT);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}
}