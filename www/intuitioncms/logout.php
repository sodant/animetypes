<?php
/**
 * Created by PhpStorm.
 * User: mick_
 * Date: 11/8/2015
 * Time: 7:55 PM
 */

session_start();
if(isset($_SESSION["loggedin"])){

    unset($_SESSION["loggedin"]);

}

header('Location: index.php');

?>