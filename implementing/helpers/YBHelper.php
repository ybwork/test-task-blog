<?php

namespace implementing\helpers;

use \interfaces\helpers\IHelper;

class YBHelper implements IHelper
{
    /**
     * Makes correct value from select field
     *
     * @param $field - name field
     * @param $request - data from POST request
     * @return field with data or empty string
     */
	public function get_select2_value(string $field, array $request)
    {
    	if (array_key_exists("$field", $request)) {
    		$data = [];

    		foreach ($request["$field"] as $key => $value) {
    			$data[$key] = (int) $value;
    		}
		} else {
			$data = '';
		}

		return $data;
    }

    /**
     * Makes correct value from select checkbox
     *
     * @param $field - name field
     * @param $request - data from POST request
     * @return field with data or empty string
     */
	public function get_checkbox_value(string $field, array $request)
    {
    	if (array_key_exists("$field", $request)) {
    		$data = [];
    		
    		foreach ($request["$field"] as $key => $value) {
    			$data[$key] = (int) $value;
    		}
		} else {
			$data = '';
		}

		return $data;
    }

    /**
     * Transform date and time for front-end
     * 
     * @param $date_time_start_auction - where start auction
     * @param date_time_stop_auction - where end auction
     * @return array with date and time in new format
     */
    public function transform_date_time(string $date_time_start_auction, string $date_time_stop_auction)
    {
    	$date_time_start_stop_auction = [];

		$names_mouths = [
			'Jan' => '01',
			'Feb' => '02',
			'Mar' => '03',
			'Apr' => '04',
			'May' => '05',
			'Jun' => '06',
			'Jul' => '07',
			'Aug' => '08',
			'Sep' => '09',
			'Oct' => '10',
			'Nov' => '11',
			'Dec' => '12',
		];

		$date_time_start = explode('-', str_replace(' ', '-', $date_time_start_auction));
		$date_time_start_stop_auction['year_start'] = $date_time_start[0];
		$date_time_start_stop_auction['mounth_start'] = array_search($date_time_start[1], $names_mouths);
		$date_time_start_stop_auction['day_start']= $date_time_start[2];
		$date_time_start_stop_auction['time_start'] = $date_time_start[3];

		$date_time_stop = explode('-', str_replace(' ', '-', $date_time_stop_auction));
		$date_time_start_stop_auction['year_stop'] = $date_time_stop[0];
		$date_time_start_stop_auction['mounth_stop'] = array_search($date_time_stop[1], $names_mouths);
		$date_time_start_stop_auction['day_stop'] = $date_time_stop[2];
		$date_time_start_stop_auction['time_stop'] = $date_time_stop[3];

		return $date_time_start_stop_auction;
    }

    /**
     * Gets current page from $_GET
     *
     * @return number page
     */
    public function get_page()
    {
    	if (!$_GET) {
			$page = 1;
        } else {        	
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
        }

        return $page;
    }

    /**
     * Gets current page from current url
     *
     * @return number page
     */
    public function get_id()
    {
        $arr = explode('/', $_SERVER['REQUEST_URI']);
        return $id = (int) end($arr);
    }
}