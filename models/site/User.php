<?php

namespace models\site;

use \interfaces\models\site\IUserModel;

class User
{
    private $model;

    /**
     * Sets model
     *
     * @param IUserModel $model - object implementing interface IAuctionModel
     */
    public function set_model(IUserModel $model)
    {
        $this->model = $model;
    }

    /**
     * Shows selected user
     *
     * @param $id - user id
     * @return result of the function show
     */
    public function show(int $id)
    {
        return $this->model->show($id);
    }

    /**
     * Update selected user
     *
     * @param $data - data for update
     * @return result of the function show
     */
    public function update(array $data)
    {
        return $this->model->update($data);
    }
}