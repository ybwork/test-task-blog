<?php

namespace implementing\models\site;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\site\IArchiveModel;

class MySQLArchiveModel implements IArchiveModel
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
	}

	/**
	 * Gets all archive auctions from db by offset/limit
	 *
	 * @param $offset - place for start
	 * @param $limit - record number limit
	 * @return array data or status code
	 */
	public function get_all_by_offset_limit(int $offset, int $limit)
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT a.id, a.step_bet, a.start, a.stop, l.name, l.description, l.price, u.login as winner FROM auctions a LEFT JOIN lots l ON a.lot_id = l.id LEFT JOIN winners w ON a.id = w.auction_id LEFT JOIN users u ON w.user_id = u.id WHERE a.status = :status ORDER BY a.id DESC LIMIT :offset, :limit';

		$query = $db->prepare($sql);

		$query->bindValue(':status', 3, \PDO::PARAM_INT);
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
		
		$sql = 'SELECT COUNT(*) FROM auctions WHERE status = :status';

		$query = $db->prepare($sql);

		$query->bindValue(':status', 3, \PDO::PARAM_INT);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response();
		}
	}
}