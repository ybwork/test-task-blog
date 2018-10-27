<?php

namespace controllers\auth;

use \components\ValidatorImp;
use \models\auth\AuthImp;

class AuthController
{
	private $model;
	private $helper;
	private $validator;

	public function __construct()
	{
		$this->validator = new ValidatorImp();
		$this->model = new AuthImp();
	}
	
	public function login()
	{
		$this->validator->check_request($_POST);

        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];

   		$user = $this->model->login($data);
   		if ($user) {
   			$_SESSION['id'] = $user['id'];
			$_SESSION['login'] = $user['login'];

			header('HTTP/1.0 200 OK', http_response_code(200));
			$response['message'] = 'Готово';
			echo json_encode($response);
   		} else {
       		header('HTTP/1.0 400 Bad Request', http_response_code(400));
			$response['message'] = 'Неправильные логин или пароль';
			echo json_encode($response);
   		}		
	}

    public function logout() {
        unset($_SESSION['id']);
        unset($_SESSION['login']);
        header("Location: /login");
    }
}