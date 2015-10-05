<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/30/15
 * Time: 12:50 PM
 */

namespace controller;
include("../private/lib/data/MysqliAdapter.php");
include("../private/config/MysqlConfig.php");

use config\MysqlConfig;
use data\MysqliAdapter;

class SiteController {

    public $_menuItems = array();

    public function init(){


        $mysqlconfig = new MysqlConfig(
            mysql_username,         //username
            mysql_password,             //password
            mysql_host,    //host
            mysql_database); //database



        $dataAdapter = new MysqliAdapter($mysqlconfig);

        $this->_menuItems = $dataAdapter->getMenu();

    }

}


