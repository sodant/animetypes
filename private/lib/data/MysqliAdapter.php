<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 9:04 PM
 */

namespace data;
use config\MysqlConfig;

include("AbstractAdapter.php");

class MysqliAdapter extends AbstractAdapter{

    private $mysqli;
    private $acceptedArgs = array("name", "type", "anime", "limit", "row_offset");
    private $argCount = 0;
    private $limit = 4;

    public function getAllCharacters($args = NULL){

        $query = $this->buildQuery(isset($args) ? $args : NULL);

        if ($stmt = $this->mysqli->prepare($query)) {

            /* execute query */
            $stmt->execute();

            /* fetch value */
            $result = $stmt->get_result();
            $stmt->close();

            $_rows = array();

            while($row = mysqli_fetch_assoc($result)) {
                $_rows[] = $row;
            }
            return $_rows;
            /* close statement */
        }
    }

    public function getCharacterByAlias($alias){

        $query="SELECT
            `character`.`character_id`,
            `character`.`character_name`,
            `character`.`character_imagesrc`,
            `character`.`character_anime`,
            `character`.`character_mbti_type`,
            `anime`.`anime_name`,
            `anime`.`anime_id`
            FROM `character`
            INNER JOIN `anime`
            ON `character`.`character_anime` = `anime`.`anime_id`
            WHERE LOWER(REPLACE(`character`.`character_name`, ' ', '-')) = ?;
            ";


        if ($stmt = $this->mysqli->prepare($query)) {


            $stmt->bind_param('s', $alias);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $rows = array();
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public function getQuotesByCharacterId($id){

        $query="SELECT * FROM `character_quote` WHERE `character_quote_source` = ?;";

        if ($stmt = $this->mysqli->prepare($query)) {

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $rows = array();
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            return $rows;
        }


    }
    public function getMenu(){

        if ($stmt = $this->mysqli->prepare("SELECT * FROM `menu`;")) {

             /* execute query */
            $stmt->execute();

            /* fetch value */
            $result = $stmt->get_result();
            $stmt->close();

            $_rows = array();

            while($row = mysqli_fetch_assoc($result)) {
                $_rows[] = $row;
            }
            return $_rows;
            /* close statement */
        }

    }

    private function buildQuery($args){

        $query= "SELECT
        `character`.`character_id`,
        `character`.`character_name`,
        `character`.`character_imagesrc`,
        `character`.`character_anime`,
        `character`.`character_mbti_type`,
        `anime`.`anime_name`,
        `anime`.`anime_id`
        FROM `character`
        INNER JOIN `anime`
        ON `character`.`character_anime` = `anime`.`anime_id`
        ";

        $limit = " LIMIT ". $this->limit;


        if(isset($args) && count($args) > 0){

            $insertAnd = false;
            for ($i = 0; $i < count($this->acceptedArgs); $i++) {

                $key = $this->acceptedArgs[$i];



                if(isset($args[$key])) {

                    $value = $args[$key];
                    switch ($key) {

                        case"name":
                            $query .= "WHERE";
                            $query .= "`character_name` LIKE '%" . $value . "%' ";
                            $insertAnd = true;
                            break;
                        case"type":
                            if (!$insertAnd)
                                $query .= "WHERE";
                            else
                                $query .= " AND ";
                            $query .= "`character_mbti_type` = '" . $value . "' ";
                            $insertAnd = true;
                            break;
                        case"anime":
                            if (!$insertAnd)
                                $query .= "WHERE";
                            else
                                $query .= " AND ";
                            $query .= "`anime_name` LIKE '%" . $value . "%' ";
                            break;
                        case"limit":
                            $this->limit = $value;
                            $limit = " LIMIT ". $this->limit;
                            break;
                        case"row_offset":
                            $limit = " LIMIT " . $value . ", " . $this->limit;
                            break;
                    }
                }



            }
        }
        $query.=" ORDER BY `character`.`character_name`".$limit. ';';

        return $query;

    }



    function __construct(MysqlConfig $config){
        $this->mysqli = new \mysqli($config->host,$config->username, $config->password,$config->database);

    }


} 