<?php

namespace implementing\models\admin;

use \components\Validator;
use \components\Helper;
use \components\DBConnection;
use \implementing\validators\YBValidator;
use \implementing\helpers\YBHelper;
use \dbconnections\MySQLConnection;
use \interfaces\models\admin\IUserModel;
use \implementing\models\YBModel;

class MySQLUserModel extends YBModel implements IUserModel
{
	public $db_connection;
	public $validator;
	public $table_name;
	public $fields;
	public $binding_fields;
	public $rules_validation;

	public function __construct()
	{
		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator());

		$this->db_connection = new DBConnection();
		$this->db_connection->set_connection(new MySQLConnection);

		$this->table_name = 'users';

		$this->fields = 'login, password, role';
        $this->binding_fields_for_create = ':login, :password, :role';

		$this->rules_validation = [
            'login' => 'Логин|empty|length_string',
            'password' => 'Пароль|empty|length_string',
        ];
	}

    /**
     * Gets all users from db
     *
     * @return array data or status code
     */
    public function get_all()
    {
        $db = $this->db_connection->get_connection();

        $sql = "SELECT id, login FROM users WHERE role = :role ORDER BY id DESC";

        $query = $db->prepare($sql);

        $query->bindValue(':role', 2, \PDO::PARAM_INT);

        if ($query->execute()) {
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            http_response_code(500);
            $this->validator->check_response();
        }
    }

    /**
     * Gets all users from db by offset/limit
     *
     * @return array data or status code
     */
	public function get_all_by_offset_limit(int $offset, int $limit)
	{
		$db = $this->db_connection->get_connection();

        $sql = "SELECT id, login FROM users WHERE role = :role ORDER BY id DESC LIMIT :offset, :limit";

       	$query = $db->prepare($sql);

       	$query->bindValue(':role', 2, \PDO::PARAM_INT);
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
     * Updates selected data from db
     * 
     * @param $data - data for update
     * @return status code and response in json or only status code
     */
    public function update(array $data)
    {
        $data = $this->validator->validate($data, [
            'login' => 'Логин|empty|length_string'
        ]);

        $db = $this->db_connection->get_connection();

        $existing_user = $this->check_exists($data);
        if ($existing_user && (int) $existing_user['id'] != $data['id']) {
            header('HTTP/1.0 400 Bad Request', http_response_code(400));

            $response['message'] = 'Пользователь с таким логином уже существует';

            echo json_encode($response);
            die();
        }

        if (!$data['password']) {
            $condition = 'login = :login';
        } else {
            $condition = 'login = :login, password = :password';
        }

        $sql = "UPDATE users SET $condition WHERE id = :id";

        $query = $db->prepare($sql);

        $user_id = (int) $data['id'];
        $query->bindValue(':id', $user_id, \PDO::PARAM_INT);
        $query->bindValue(':login', $data['login'], \PDO::PARAM_STR);
        if ($data['password']) {
            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            $query->bindValue(':password', $password);
        }

        if ($query->execute()) {        	
			header('HTTP/1.0 200 OK', http_response_code(200));

			$response['message'] = 'Готово';
			$response['data'] = $data;

			echo json_encode($response);
        } else {
			http_response_code(500);
			$this->validator->check_response('ajax');
        }
    }
    
    /**
     * Checks data on exists
     * 
     * @return array data or status code
     */
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