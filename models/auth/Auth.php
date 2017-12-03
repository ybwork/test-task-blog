<?php

namespace models\auth;

use \interfaces\models\auth\IAuthModel;

class Auth
{
    private $model;

    /**
     * Sets model
     *
     * @param IAuthModel $model - object implementing interface IAuctionModel
     */
    public function set_model(IAuthModel $model)
    {
    	$this->model = $model;
    }  

    /**
     * Logins user from system
     *
     * @param $data - current user data from form
     * @param $user - user data from db 
     */
    public function login(array $data, array $user)
    {
        return $this->model->login($data, $user);
    }
}