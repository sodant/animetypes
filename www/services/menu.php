<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 9:58 PM
 */

namespace service;
use config\MysqlConfig;
use data\AbstractAdapter;
use data\MysqliAdapter;

include("../../private/config.php");
include("../../private/lib/data/MysqliAdapter.php");
include("../../private/config/MysqlConfig.php");

class MenuService {

    protected $dataDapter;


    public function getMenu(){

        return $this->dataDapter->getMenu();

    }

    function __construct(AbstractAdapter $dataAdapter){
        $this->dataDapter = $dataAdapter;
    }

}

$mysqlconfig = new MysqlConfig(
    mysql_username,         //username
    mysql_password,             //password
    mysql_host,    //host
    mysql_database); //database


$dataAdapter = new MysqliAdapter($mysqlconfig);
$characterService = new MenuService($dataAdapter);



    echo '{"menu":'.json_encode($characterService->getMenu()).'}';