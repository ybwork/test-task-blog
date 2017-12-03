<?php

namespace models\admin;

use \interfaces\models\admin\ILotModel;

class Lot
{
	private $model;

    /**
     * Sets model
     *
     * @param ILotModel $model - object implementing interface IAuctionModel
     */
	public function set_model(ILotModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Gets all lots
	 *
	 * @return result of the function get_all
	 */
	public function get_all()
	{
		return $this->model->get_all();
	}

	/**
	 * Gets all lots by offset/limit
	 *
	 * @param $offset - place start 
	 * @param $limit - record limit
	 * @return result of the function get_all_by_offset_limit
	 */
	public function get_all_by_offset_limit(int $offset, int $limit)
	{
		return $this->model->get_all_by_offset_limit($offset, $limit);
	}

	/**
	 * Creates lot
	 *
	 * @param $data - data from request
	 * @return result of the function create
	 */
	public function create(array $data)
	{
		return $this->model->create($data);
	}

	/**
	 * Shows selected lot
	 *
	 * @param $id - lot id
	 * @return result of the function show
	 */
	public function show(int $id)
    {
        return $this->model->show($id);
    }

	/**
	 * Updates selected lot
	 *
	 * @param $id - lot id
	 * @return result of the function update
	 */
    public function update(array $data)
    {
        return $this->model->update($data);
    }

	/**
	 * Deletes selected lot
	 *
	 * @param $id - lot id
	 * @return result of the function delete
	 */
    public function delete(int $id)
    {
        return $this->model->delete($id);
    }

	/**
	 * Counts lots
	 *
	 * @return result of the function count
	 */
    public function count()
    {
        return $this->model->count();
    }
}