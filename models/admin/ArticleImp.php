<?php

namespace models\admin;

use \interfaces\models\admin\Article;
use \components\ValidatorImp;
use \components\HelperImp;
use \components\DBConnectionImp;
use \models\ModelImp;

class ArticleImp extends ModelImp implements Article
{
	public $db_connection;
	public $validator;
	public $table_name;
	public $fields;
	public $binding_fields_for_create;
	public $binding_fields_for_update;
	public $rules_validation;
	
	public function __construct()
	{
		$this->validator = new ValidatorImp();
		$this->db_connection = new DBConnectionImp();

		$this->table_name = 'articles';

		$this->fields = 'title, text';
		$this->binding_fields_for_create = ':title, :text';
		$this->binding_fields_for_update = 'title = :title, text = :text';

		$this->rules_validation = [
            'title' => 'Заголовок|empty|length_string',
            'text' => 'Текст|empty|length_string',
        ];
	}
}