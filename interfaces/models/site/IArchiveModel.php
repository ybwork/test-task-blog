<?php

namespace interfaces\models\site;

interface IArchiveModel
{
	public function get_all_by_offset_limit(int $offset, int $limit);
	public function count();
}