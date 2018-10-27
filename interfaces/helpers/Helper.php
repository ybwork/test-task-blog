<?php

namespace interfaces\helpers;

interface Helper
{
	public function get_select2_value(string $field, array $request);
	public function get_checkbox_value(string $field, array $request);
    public function transform_date_time(string $date_time_start_auction, string $date_time_stop_auction);
    public function get_page();
   	public function get_id();
}