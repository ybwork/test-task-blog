<?php

namespace models\site;

use \interfaces\models\site\IArchiveModel;

class Archive
{
    /**
     * Sets model
     *
     * @param IArchiveModel $model - object implementing interface IArchiveModel
     */
	public function set_model(IArchiveModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Gets all archive auctions by offset/limit
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
	 * Counts archive auctions
	 *
	 * @return result of the function count
	 */
    public function count()
    {
        return $this->model->count();
    }
}