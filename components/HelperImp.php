<?php

namespace components;

use \interfaces\helpers\Helper;

class HelperImp
{
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

    public function get_id()
    {
        $arr = explode('/', $_SERVER['REQUEST_URI']);
        return $id = (int) end($arr);
    }
}