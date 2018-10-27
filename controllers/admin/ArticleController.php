<?php

namespace controllers\admin;

use \components\Validator;
use \components\Paginator;
use \components\Helper;
use \implementing\validators\YBValidator;
use \implementing\paginators\YBPaginator;
use \implementing\helpers\YBHelper;
use \models\admin\ArticleImp;

class ArticleController
{
    public $model;
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

        $this->helper = new Helper();
        $this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());

		$this->model = new ArticleImp();
	}

    /**
     * Shows all lots
     *
     * @return html view
     */
    public function index()
    {
        // var_dump($this->model); die();
        /*
            Заменить обычный вывод, когда появится js

            $limit = 2;
            $page = $this->helper->get_page();
            $offset = ($page - 1) * $limit;

            $count = $this->model->count();
            $total = $count[0]['COUNT(*)'];
            $index = '?page=';

            $lots = $this->model->get_all_by_offset_limit($offset, $limit);

            $this->paginator->set_params($total, $page, $limit, $index);
        */

        $lots = $this->model->get_all();

        require_once(ROOT . '/views/admin/lot/index.php');
        return true;
    }

    /**
     * Collects data for create lot
     *
     * @return result in json and/or http headers with status code
     */
    public function create()
    {
        $this->validator->check_request($_POST);

        $data['name'] = (string) $_POST['name'];
        $data['description'] = (string) $_POST['description'];
        $data['price'] = (int) $_POST['price'];
        
        $this->model->create($data);
    }

    /**
     * Collects data for update lot
     *
     * @return result in json and/or http headers with status code
     */
    public function update()
    {
        $this->validator->check_request($_POST);

        $data['id'] = (int) $_POST['id'];
        $data['name'] = (string) $_POST['name'];
        $data['description'] = (string) $_POST['description'];
        $data['price'] = (int) $_POST['price'];

        $this->model->update($data);
    }

    /**
     * Collects data for delete lot
     *
     * @return result in json and/or http headers with status code
     */
    public function delete()
    {
        $this->validator->check_request($_POST);
        
        $id = (int) $_POST['id'];

        $this->model->delete($id);
    }
}