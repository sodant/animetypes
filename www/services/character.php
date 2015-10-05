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

define("JSON_NAME_CHARACTERS", '{"characters":[j]}');
define("JSON_NAME_CHARACTERS_SINGLE_ROW", '{"character":[j]}');
define("JSON_NAME_QUOTES", '{"quotes":[j]}');



class CharacterService {

    protected $dataDapter;

    private function getCharacterByAlias(){
        if(isset($_GET["character_alias"])){
            return json_encode($this->dataDapter->getCharacterByAlias($_GET["character_alias"]));
        }
        else{
            die("get parameter character_alias missing.");
        }

    }

    private function getAllCharacters(){

        if (isset($_GET["filter"]) && is_array($_GET["filter"])) {

            return json_encode($this->dataDapter->getAllCharacters($_GET["filter"]));

        }
        return json_encode($this->dataDapter->getAllCharacters());
    }

    private function getQuotesByCharacterId(){

        if(isset($_GET["character_id"])){
            return json_encode($this->dataDapter->getQuotesByCharacterId($_GET["character_id"]));
        }
        else{
            die("get parameter character_id missing.");
        }

    }

    public function search(){

    }


    private function handleRequesttwo()
    {




    }

    private function isValidValue($key){

        return true;

    }

    public function handleRequest(){

        if(isset($_GET["action"])){
            switch($_GET["action"]){
                case "getcharacters":
                    return str_replace("[j]", $this->getAllCharacters(), JSON_NAME_CHARACTERS);
                case "getcharacterbyalias":
                    return str_replace("[j]", $this->getCharacterByAlias(), JSON_NAME_CHARACTERS_SINGLE_ROW);
                case "search":
                    $_like = array();
                    foreach($_GET as $key => $value){
                        if(substr( $key, 0, 7 ) == "search-") {

                            $partialKey = explode("_", $key)[1];
                            $_like[$partialKey] = $value;
                        }
                    }
                    return str_replace("[j]", $this->search($_like), JSON_NAME_QUOTES);
                case "getquotesbycharacterid":
                    return str_replace("[j]", $this->getQuotesByCharacterId(), JSON_NAME_QUOTES);
            }
        }

    }

    function __construct(AbstractAdapter $dataAdapter){
        $this->dataDapter = $dataAdapter;
    }

}

$mysqlConfig = new MysqlConfig(
    mysql_username,         //username
    mysql_password,             //password
    mysql_host,    //host
    mysql_database); //database


$dataAdapter = new MysqliAdapter($mysqlConfig);
$characterService = new CharacterService($dataAdapter);
print_r( $characterService->handleRequest());

