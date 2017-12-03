<?php

namespace implementing\models\site;

use \components\Validator;
use \implementing\validators\YBValidator;
use \components\Helper;
use \implementing\helpers\YBHelper;
use \components\DBConnection;
use \dbconnections\MySQLConnection;
use \interfaces\models\site\IBetModel;
use \implementing\models\YBModel;

class MySQLBetModel extends YBModel implements IBetModel
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

        $this->table_name = 'bets';

        $this->fields = 'auction_id, user_id, bet';
        $this->binding_fields_for_create = ':auction_id, :user_id, :bet';
        
        $this->rules_validation = [
            'auction_id' => 'Аукцион|empty|is_integer|length_integer',
            'user_id' => 'Пользователь|empty|is_integer|length_integer',
            'bet' => 'Ставка|empty|is_integer|length_integer',
        ];
	}

	/**
	 * Gets all bets by auction from db
	 *
	 * @param $id - auction id
	 * @return array data or status code
	 */
	public function get_all_by_auction_id(int $id)
	{
		$db = $this->db_connection->get_connection();

		$sql = 'SELECT b.auction_id, b.user_id, b.bet, b.date_time_creation, u.login as user_login FROM bets b LEFT JOIN users u ON b.user_id = u.id WHERE b.auction_id = :id ORDER BY b.id DESC';

		$query = $db->prepare($sql);

		$query->bindValue(':id', $id);

		if ($query->execute()) {
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->check_response();
		}
	}
}