<?php

namespace routers;

interface Router
{
	public function get_url();
	public function activate_handlers($handlers);
	public function run();
}