<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 11:53 PM
 */

namespace config;


define("mysql_username", "anime-types.com");
define("mysql_password", "KaoloKanker2");
define("mysql_host", "localhost");
define("mysql_database", "anime-types.com");

/**
define("mysql_username", "root");
define("mysql_password", "");
define("mysql_host", "localhost");
define("mysql_database", "anime-types.com");
 * **/

static $mbtiTypes = array(
    "INTJ",
    "INTP",
    "ENTJ",
    "ENTP",
    "INFJ",
    "INFP",
    "ENFJ",
    "ENFP",
    "ISTJ",
    "ISFJ",
    "ESTJ",
    "ESFJ",
    "ISTP",
    "ISFP",
    "ESTP",
    "ESFP"
);

$configVariables["SERVICES_PATH"] = "/services";
$configVariables["SERVICE_URL_CHARACTER"] = "/character.php";
$configVariables["SITE_URL"] = "http://$_SERVER[HTTP_HOST]";
//$configVariables["SITE_URL"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$configVariables["IMAGES_FOLDER"] = "/media/images";