<?php

namespace interfaces\models\site;

interface IUserModel
{
	public function update(array $data);
	public function show(int $id);
}