<?php

namespace controllers\admin;

use \components\ValidatorImp;
use \components\PaginatorImp;
use \components\HelperImp;
use \models\admin\ArticleImp;

class ArticleController
{
    public $model;
    public $helper;
    public $validator;
    public $paginator;

	public function __construct()
	{
        $this->validator = new ValidatorImp();
        $this->validator->check_auth();

        $this->helper = new HelperImp();
        $this->paginator = new PaginatorImp();

		$this->model = new ArticleImp();
	}

    public function index()
    {
        $articles = $this->model->get_all();

        require_once(ROOT . '/views/admin/article/index.php');
        return true;
    }

    public function create()
    {
        $this->validator->check_request($_POST);

        $data['title'] = (string) $_POST['title'];
        $data['text'] = (string) $_POST['text'];
        
        $this->model->create($data);
    }

    public function update()
    {
        $this->validator->check_request($_POST);

        $data['id'] = (int) $_POST['id'];
        $data['title'] = (string) $_POST['title'];
        $data['text'] = (string) $_POST['text'];

        $this->model->update($data);
    }

    public function delete()
    {
        $this->validator->check_request($_POST);
        
        $id = (int) $_POST['id'];
        $this->model->delete($id);
    }

    public function show()
    {
        return true;
    }
}