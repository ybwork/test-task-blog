<?php

namespace implementing\models\admin;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\admin\ILotModel;
use \implementing\models\YBModel;

class MySQLLotModel extends YBModel implements ILotModel
{
	public $db_connection;
	public $validator;
	public $table_name;
	public $fields;
	public $binding_fields_for_create;
	public $binding_fields_for_update;
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

		$this->table_name = 'lots';

		$this->fields = 'name, description, price';
		$this->binding_fields_for_create = ':name, :description, :price';
		$this->binding_fields_for_update = 'name = :name, description = :description, price = :price';

		$this->rules_validation = [
            'name' => 'Имя|empty|length_string',
            'description' => 'Описание|empty|length_string',
            'price' => 'Цена|empty|is_integer|length_integer',
        ];
	}
}