<?php

namespace models\site;

use \interfaces\models\site\IWinnerModel;

class Winner
{
    /**
     * Sets model
     *
     * @param IWinnerModel $model - object implementing interface IAuctionModel
     */
	public function set_model(IWinnerModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Gets all winners
	 *
	 * @return result of the function get_all
	 */
	public function get_all()
	{
		return $this->model->get_all();
	}

	/**
	 * Gets all winners by offset/limit
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
	 * Create winner
	 *
	 * @param $data - data from request
	 * @return result of the function create
	 */
	public function create(array $data)
	{
		return $this->model->create($data);
	}

	/**
	 * Shows selected winner
	 *
	 * @param $id - winner id
	 * @return result of the function show
	 */
	public function show(int $id)
    {
        return $this->model->show($id);
    }

	/**
	 * Shows selected winner
	 *
	 * @param $id - winner id
	 * @return result of the function show
	 */
    public function update(array $data)
    {
        return $this->model->update($data);
    }

	/**
	 * Deletes selected winner
	 *
	 * @param $id - winner id
	 * @return result of the function delete
	 */
    public function delete(int $id)
    {
        return $this->model->delete($id);
    }

	/**
	 * Counts winners
	 *
	 * @return result of the function count
	 */
    public function count()
    {
        return $this->model->count();
    }
}