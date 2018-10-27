<?php

namespace models\auth;

use \components\DBConnectionImp;
use \components\ValidatorImp;
use \interfaces\models\auth\Auth;
use \models\ModelImp;

class AuthImp extends ModelImp implements Auth
{
    public $db_connection;
    public $validator;
    public $table_name;
    public $fields;
    public $binding_fields;
    public $rules_validation;

    public function __construct()
    {
        $this->validator = new ValidatorImp();
        $this->db_connection = new DBConnectionImp();
        $this->table_name = 'users';
        $this->fields = 'login, password';

        $this->rules_validation = [
            'login' => 'Логин|empty|length_string',
            'password' => 'Пароль|empty|length_string',
        ];
    }

    public function login(array $data)
    {
        $data = $this->validator->validate($data, [
            'login' => 'Логин|empty|length_string',
        ]);

        $db = $this->db_connection->get_connection();

        $sql = 'SELECT id, login, password FROM users WHERE login = :login';

        $query = $db->prepare($sql);
        $query->bindValue(':login', $data['login']);
        $query->execute();

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if ($data['login'] != $user['login']) {
            return false;
        }
        
        if (password_verify($data['password'], $user['password'])) {
            return $user;
        }

        return false;
    }
}