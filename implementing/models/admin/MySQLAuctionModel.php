<?php

namespace implementing\models\admin;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\admin\IAuctionModel;
use \implementing\models\YBModel;

class MySQLAuctionModel extends YBModel implements IAuctionModel
{
	public $db_connection;
	public $validator;
	public $table_name;
	public $fields;
	public $binding_fields;
	public $rules_validation;

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

		$this->fields = 'lot_id, step_bet, start, stop, status';
		$this->binding_fields_for_create = ':lot_id, :step_bet, :start, :stop, :status';
		$this->binding_fields_for_update = 'lot_id = :lot_id, step_bet = :step_bet, start = :start, stop = :stop, status = :status';

		$this->rules_validation = [
            'lot_id' => 'Лот|empty|is_integer|length_integer',
            'step_bet' => 'Шаг ставки|empty|is_integer|length_integer',
            'start' => 'Начало|empty|length_string',
            'stop' => 'Конец|empty|length_string',
            'status' => 'Статус|empty|is_integer|length_integer',
        ];
	}

	/**
	 * Gets all auctions from db
	 *
	 * @return array data or status code
	 */
	public function get_all()
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, a.status, l.name, l.description, l.price FROM auctions a JOIN lots l ON a.lot_id = l.id WHERE a.status = 1 OR status = 2 ORDER BY a.id DESC';

		$query = $db->prepare($sql);

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

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, l.name, l.description, l.price FROM auctions a JOIN lots l ON a.lot_id = l.id WHERE a.status = 1 OR status = 2 ORDER BY a.id DESC LIMIT :offset, :limit';

		$query = $db->prepare($sql);

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
	 * Counts data to db
	 * 
	 * @return array data or status code
	 */
	public function count()
	{
		$db = $this->db_connection->get_connection();
		
		$sql = 'SELECT COUNT(*) FROM auctions WHERE status = 1 OR status = 2';

		$query = $db->prepare($sql);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}
}