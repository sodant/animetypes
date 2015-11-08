<?php
include("../../../private/lib/data/MysqliAdapter.php");
include("../../../private/config.php");
include("../../../private/config/MysqlConfig.php");

session_start();
if(!isset($_SESSION["loggedin"])){
    header('Location: ../index.php');
}

$mysqlConfig = new \config\MysqlConfig(
    mysql_username,         //username
    mysql_password,             //password
    mysql_host,    //host
    mysql_database); //database
$mysqliAdapter = new \data\MysqliAdapter($mysqlConfig);

if(isset($_POST["id"])){

    $id = $_POST['id'];
    $mysqliAdapter->deleteAnime($id);

}
