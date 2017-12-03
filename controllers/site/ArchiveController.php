<?php

namespace controllers\site;

use \components\Validator;
use \components\Paginator;
use \components\Helper;
use \implementing\validators\YBValidator;
use \implementing\paginators\YBPaginator;
use \implementing\helpers\YBHelper;
use \models\site\Archive;
use \implementing\models\site\MySQLArchiveModel;

class ArchiveController
{
    public $model;
    public $helper;
    public $validator;
    public $paginator;

	/**
	 * Sets validator, helper, paginator, model, access
	 */
	public function __construct()
	{
        $this->validator = new Validator();
        $this->validator->set_validator(new YBValidator);
        $this->validator->check_auth();

        $roles = ['admin', 'user'];
        $this->validator->check_access($roles);

        $this->helper = new Helper();
        $this->helper->set_helper(new YBHelper());

        $this->paginator = new Paginator();
        $this->paginator->set_paginator(new YBPaginator());

		$this->model = new Archive();
		$this->model->set_model(new MySQLArchiveModel());
	}

    /**
     * Shows all archive auctions
     *
     * @return html view
     */
    public function index()
    {
        $limit = 2;
        $page = $this->helper->get_page();
        $offset = ($page - 1) * $limit;

        $count = $this->model->count();
        $total = $count[0]['COUNT(*)'];
        $index = '?page=';

        $archive_auctions = $this->model->get_all_by_offset_limit($offset, $limit);

        $this->paginator->set_params($total, $page, $limit, $index);

        require_once(ROOT . '/views/site/archive/index.php');
        return true;
    }
}