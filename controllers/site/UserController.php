<?php

namespace controllers\site;

use \components\Validator;
use \components\Paginator;
use \components\Helper;
use \implementing\validators\YBValidator;
use \implementing\paginators\YBPaginator;
use \implementing\helpers\YBHelper;
use \models\admin\User as AdminUser;
use \implementing\models\admin\MySQLUserModel as AdminMySQLUserModel;
use \models\site\User;
use \implementing\models\site\MySQLUserModel;

class UserController
{
    public $model;
    public $user;
    public $helper;
    public $validator;
    public $paginator;
    public $path_to_view;
    public $fields;

	/**
	 * Sets validator, helper, paginator, model, access
	 */
	public function __construct()
	{
        $this->validator = new Validator();
        $this->validator->set_validator(new YBValidator);
        $this->validator->check_auth();

        $roles = ['user', 'admin'];
        $this->validator->check_access($roles);

        $this->helper = new Helper();
        $this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());

		$this->model = new User();
		$this->model->set_model(new MySQLUserModel());

        $this->user = new AdminUser();
        $this->user->set_model(new AdminMySQLUserModel());
	}
    
    /**
     * Collects data for update auction
     *
     * @return result in json and/or http headers with status code
     */
    public function update()
    {
        $this->validator->check_request($_POST);

        $data['id'] = (int) $_SESSION['id'];
        $data['old_password'] = $_POST['old_password'];
        
        $current_user = $this->user->show($data['id']);
        
        if (password_verify($_POST['old_password'], $current_user['password'])) {
            $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $this->model->update($data);
        } else {
            header('HTTP/1.0 400 Bad Request', http_response_code(400));

            $response['message'] = 'Старый пароль не верен!';

            echo json_encode($response);
            die();
        }
    }
}