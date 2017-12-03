<?php

namespace interfaces\models\site;

interface IBetModel
{
	public function get_all();
	public function get_all_by_auction_id(int $id);
}