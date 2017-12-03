<?php

namespace models\site;

use \interfaces\models\site\IAuctionModel;

class Auction
{
    private $model;

    /**
     * Sets model
     *
     * @param IAuctionModel $model - object implementing interface IAuctionModel
     */
    public function set_model(IAuctionModel $model)
    {
        $this->model = $model;
    }

    /**
     * Gets all auctions
     *
     * @return result of the function get_all
     */
    public function get_all()
    {
        return $this->model->get_all();
    }

    /**
     * Gets all auctions by offset/limit
     *
     * @return result of the function get_all_by_offset_limit
     */
    public function get_all_by_offset_limit(int $offset, int $limit)
    {
        return $this->model->get_all_by_offset_limit($offset, $limit);
    }

    /**
     * Shows selected auction
     *
     * @param $id - auction id
     * @return result of the function show
     */
    public function show(int $id)
    {
        return $this->model->show($id);
    }

    /**
     * Changes auction status
     *
     * @param $id - auction id
     * @param $status - auction status
     * @return result of the function change_status
     */
    public function change_status(int $id, int $status)
    {
        return $this->model->change_status($id, $status);
    }
    
    /**
     * Counts auctions
     *
     * @return result of the function count
     */
    public function count()
    {
        return $this->model->count();
    }
}