<?php

namespace controllers\admin;

use \components\Paginator;
use \components\Helper;
use \components\Validator;
use \implementing\helpers\YBHelper;
use \implementing\paginators\YBPaginator;
use \implementing\validators\YBValidator;
use \models\admin\User;
use \implementing\models\admin\MySQLUserModel;

class UserController
{
    public $model;
    public $helper;
    public $validator;
    public $paginator;
    public $path_to_view;
    public $fields;

    /**
     * Sets validator, access, helper, model
     */
    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->set_validator(new YBValidator);
        $this->validator->check_auth();

        $roles = ['admin'];
        $this->validator->check_access($roles);

        $this->helper = new Helper();
        $this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());
        
        $this->model = new User();
        $this->model->set_model(new MySQLUserModel());
    }

    /**
     * Shows all users
     *
     * @return html view
     */
    public function index()
    {
        /*
            Заменить обычный вывод, когда появится js

            $limit = 20;
            $page = $this->helper->get_page();
            $offset = ($page - 1) * $limit;

            $count = $this->model->count();
            $total = $count[0]['COUNT(*)'];
            $index = '?page=';

            $users = $this->model->get_all_by_offset_limit($offset, $limit);

            $this->paginator->set_params($total, $page, $limit, $index);
        */

        $users = $this->model->get_all();

        require_once(ROOT . '/views/admin/user/index.php');
        return true;
    }

    /**
     * Collects data for create user
     *
     * @return result in json and/or http headers with status code
     */
    public function create()
    {
        $this->validator->check_request($_POST);

        $data['login'] = $_POST['login'];
        $data['role'] = 2;

        if ($_POST['password']) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $data['password'] = $_POST['password'];
        }

        $this->model->create($data);
    }

    /**
     * Collects data for update user
     *
     * @return result in json and/or http headers with status code
     */
    public function update()
    {
        $this->validator->check_request($_POST);

        $data['id'] = (int) $_POST['id'];
        $data['login'] = (string) $_POST['login'];
        $data['password'] = (string) $_POST['password'];
        $data['role'] = 2;

        $this->model->update($data);
    }

    /**
     * Collects data for delete user
     *
     * @return result in json and/or http headers with status code
     */
    public function delete()
    {
        $this->validator->check_request($_POST);
        
        $id = (int) $_POST['id'];

        $this->model->delete($id);
    }

    /**
     * Logout user from system
     *
     * @return status code
     */
    public function logout() {
        unset($_SESSION['id']);
        unset($_SESSION['login']);
        unset($_SESSION['role']);
        header("Location: /login");
    }
}