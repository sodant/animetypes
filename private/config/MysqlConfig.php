<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 11:57 PM
 */

namespace config;


class MysqlConfig {

    public $username;
    public $password;
    public $host;
    public $database;


    function __construct( $username,  $password,  $host, $database){
        $this->username=$username;
        $this->password=$password;
        $this->host=$host;
        $this->database=$database;
    }

} 