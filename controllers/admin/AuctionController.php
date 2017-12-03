<?php

namespace controllers\admin;

use \components\Validator;
use \components\Paginator;
use \components\Helper;
use \implementing\validators\YBValidator;
use \implementing\paginators\YBPaginator;
use \implementing\helpers\YBHelper;
use \models\admin\Auction;
use \implementing\models\admin\MySQLAuctionModel;
use \models\admin\Lot;
use \implementing\models\admin\MySQLLotModel;

class AuctionController
{
    public $model;
    public $lot;
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

        $roles = ['admin'];
        $this->validator->check_access($roles);

        $this->helper = new Helper();
        $this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());

		$this->model = new Auction();
		$this->model->set_model(new MySQLAuctionModel());

        $this->lot = new Lot();
        $this->lot->set_model(new MySQLLotModel());
	}

    /**
     * Shows all auctions
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

            $auctions = $this->model->get_all_by_offset_limit($offset, $limit);
            $this->paginator->set_params($total, $page, $limit, $index);
        */

        $auctions = $this->model->get_all();
        $lots = $this->lot->get_all();

        require_once(ROOT . '/views/admin/auction/index.php');
        return true;
    }

    /**
     * Collects data for create auction
     *
     * @return result in json and/or http headers with status code
     */
    public function create()
    {
        $this->validator->check_request($_POST);

        $data['lot_id'] = (int) $_POST['lot_id'];
        $data['step_bet'] = (int) $_POST['step_bet'];
        $data['start'] = (string) $_POST['start'];
        $data['stop'] = (string) $_POST['stop'];
        $data['status'] = (int) $_POST['status'];
        
        $this->model->create($data);
    }

    /**
     * Collects data for update auction
     *
     * @return result in json and/or http headers with status code
     */
    public function update()
    {
        $this->validator->check_request($_POST);

        $data['id'] = (int) $_POST['id'];
        $data['lot_id'] = (int) $_POST['lot_id'];
        $data['step_bet'] = (int) $_POST['step_bet'];
        $data['start'] = (string) $_POST['start'];
        $data['stop'] = (string) $_POST['stop'];
        $data['status'] = (int) $_POST['status'];

        $this->model->update($data);
    }

    /**
     * Collects data for delete auction
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