<?php

namespace implementing\models\site;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\site\IWinnerModel;
use \implementing\models\YBModel;

class MySQLWinnerModel extends YBModel implements IWinnerModel
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

        $this->table_name = 'winners';

        $this->fields = 'auction_id, user_id';
        $this->binding_fields_for_create = ':auction_id, :user_id';
        
        $this->rules_validation = [
            'auction_id' => 'Аукцион|empty|is_integer|length_integer',
            'user_id' => 'Пользователь|empty|is_integer|length_integer',
        ];
	}
}