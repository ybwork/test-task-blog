<?php

namespace interfaces\models\site;

interface IAuctionModel
{
	public function get_all();
	public function show(int $id);
	public function change_status(int $id, int $status);
}