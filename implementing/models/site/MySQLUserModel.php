<?php

namespace implementing\models\site;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\site\IUserModel;
use \implementing\models\YBModel;

class MySQLUserModel extends YBModel implements IUserModel
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

        $this->table_name = 'users';

        $this->fields = 'password';
        $this->binding_fields_for_update = 'password = :password';
        
        $this->rules_validation = [
            'password' => 'Пароль|empty|length_string',
        ];
	}

    public function check_exists(array $data)
    {
        $data = $this->validator->validate($data, [
            'login' => 'Логин|empty|length_string',
        ]);

        $db = $this->db_connection->get_connection();

        $sql = 'SELECT id, login, password, role FROM users WHERE login = :login';

        $query = $db->prepare($sql);

        $query->bindValue(':login', $data['login']);

		if ($query->execute()) {
			return $query->fetch(\PDO::FETCH_ASSOC);
		} else {
			http_response_code(500);
			$this->validator->check_response('ajax');
		}
    }
}