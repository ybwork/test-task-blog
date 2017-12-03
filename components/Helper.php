<?php

namespace components;

use \interfaces\helpers\IHelper;

class Helper
{
	private $helper;

    /**
     * Sets helper 
     *
     * @param IHelper $helper - object implementing IHelper
     */
	public function set_helper(IHelper $helper)
	{
		$this->helper = $helper;
	}

    /**
     * Gets value from select field (used plugin select2.js) 
     *
     * @param $field - field name
     * @param $request - data from form
     * @return result of the function get_select2_value
     */
	public function get_select2_value(string $field, array $request)
    {
    	return $this->helper->get_select2_value($field, $request);
    }

    /**
     * Gets value from checkbox 
     *
     * @param $field - field name
     * @param $request - data from form
     * @return result of the function get_checkbox_value
     */
	public function get_checkbox_value(string $field, array $request)
    {
    	return $this->helper->get_checkbox_value($field, $request);
    }

    /**
     * Changes date time for front-end
     *
     * @param $date_time_start_auction - time and date start auction
     * @param $date_time_stop_auction - time and date stop auction
     * @return array with data
     */
    public function transform_date_time(string $date_time_start_auction, string $date_time_stop_auction)
    {
        return $this->helper->transform_date_time($date_time_start_auction, $date_time_stop_auction);
    }

    /**
     * Gets number page with current url
     *
     * @return result of the function get_page
     */
    public function get_page()
    {
    	return $this->helper->get_page();
    }

    /**
     * Gets id with current url
     *
     * @return result of the function get_page
     */
    public function get_id()
    {
        return $this->helper->get_id();
    }
}