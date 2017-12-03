<?php

namespace controllers\auth;

use \components\Helper;
use \components\Validator;
use \implementing\helpers\YBHelper;
use \implementing\validators\YBValidator;
use \models\auth\Auth;
use \implementing\models\auth\MySQLAuthModel;
use \models\admin\User;
use \implementing\models\admin\MySQLUserModel;

class LoginController
{
	private $model;
	private $user;
	private $helper;
	private $validator;

	/**
	 * Sets validator, helper, model
	 */
	public function __construct()
	{
		$this->model = new Auth();
		$this->model->set_model(new MySQLAuthModel());

		$this->user = new User();
		$this->user->set_model(new MySQLUserModel());

		$this->helper = new Helper();
		$this->helper->set_helper(new YBHelper());

		$this->validator = new Validator();
		$this->validator->set_validator(new YBValidator);
	}

	/**
	 * Shows form for login
	 *
	 * @return html view
	 */	
	public function index()
	{
		if (isset($_SESSION['login'])) {
			header('Location: /');
		}

        require_once(ROOT . '/views/auth/login.php');
        return true;
	}
	
	/**
	 * Collects data for login user in system
	 *
	 * @return json and http headers with status code
	 */
	public function login()
	{
		$this->validator->check_request($_POST);

        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];

		$user = $this->user->check_exists($data);

		if ($user) {
       		$auth = $this->model->login($data, $user);

       		if ($auth) {
       			$_SESSION['id'] = $user['id'];
				$_SESSION['login'] = $user['login'];
				$_SESSION['role'] = $user['role'];

				header('HTTP/1.0 200 OK', http_response_code(200));

				$response['message'] = 'Готово';
				
				echo json_encode($response);
       		} else {
	       		header('HTTP/1.0 400 Bad Request', http_response_code(400));

				$response['message'] = 'Неправильные логин или пароль';

				echo json_encode($response);
       		}
		} else {
       		header('HTTP/1.0 400 Bad Request', http_response_code(400));

			$response['message'] = 'Неправильные логин или пароль';

			echo json_encode($response);
		}		
	}
}