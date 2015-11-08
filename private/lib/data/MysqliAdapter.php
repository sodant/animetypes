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

    public function getAnime(){

        $query="SELECT * FROM `anime` ORDER BY `anime_name` ASC;";

        if ($stmt = $this->mysqli->prepare($query)) {

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

    public function deleteCharacter($id){

        $query="DELETE FROM `character` WHERE `character_id` = ?;";

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

    public function deleteAnime($id){

        $query="DELETE FROM `anime` WHERE `anime_id` = ?;";

        if ($stmt = $this->mysqli->prepare($query)) {

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $rows = array();
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            return true;
        }


    }

    public function saveCharacterFromPost(){

        $id = $_POST["character-id"];
        $name = $_POST["character-name"];
        $anime = $_POST["character-anime"];
        $type = $_POST["character-type"];


        $portrait = $_POST["image-data"];
        $fileName = uniqid($this->slug($name)).".jpg";

        $portrait = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $portrait));
        file_put_contents('../../media/images/characters/'.$fileName, $portrait);

        $query="INSERT INTO `character` (character_name, character_imagesrc, character_anime, character_mbti_type)";
        $query.=" VALUES (?,?,?,?)";
        if($id > 0){

            $query="UPDATE `character`";
            $query.="SET `character_name`= ?, `character_imagesrc`= ?, `character_anime`= ?, `character_mbti_type`= ?";
            $query.=" WHERE `character_id`= ?";

        }

        if ($stmt = $this->mysqli->prepare($query)) {

            if($id > 0){

                $stmt->bind_param('ssisi', $name, $fileName, $anime, $type, $id);
            }else{
                $stmt->bind_param('ssis', $name, $fileName, $anime, $type);
            }

            $stmt->execute();
            $stmt->close();

            if($id < 0) {
                $getIdQuery = "SELECT `character_id` FROM `character` ORDER BY `character_id` DESC LIMIT 0, 1;";
                if ($stmt = $this->mysqli->prepare($getIdQuery)) {
                    $stmt->execute();
                    $result = $stmt->get_result();


                    $stmt->close();
                    $characterRow = null;
                    $rows = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $characterRow = $row;
                    }

                    $highestId = 0;

                    if (isset($characterRow["character_id"])) {
                        $highestId = $characterRow["character_id"];
                    }

                    $_POST["character-id"] = $highestId;
                }
            }

        }

        $this->saveQuotesFromPost();




        return false;
    }


    public function saveQuotesFromPost(){

        $id = $_POST["character-id"];
        $quotes = $_POST["character-quotes"];
        $query="DELETE FROM `character_quote` WHERE `character_quote_source`= ?;";

        if ($stmt = $this->mysqli->prepare($query)) {

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
        }


        if(count($quotes) > 0){


            foreach($quotes as $quote){

                if(strlen($quote) > 0){

                    $query="INSERT INTO `character_quote` (character_quote_value, character_quote_source)";
                    $query.=" VALUES (?,?)";
                    if ($stmt = $this->mysqli->prepare($query)) {
                        $stmt->bind_param('si', $quote, $id);
                        $stmt->execute();
                        $stmt->close();

                    }
                }

            }


        }
        return true;
    }

    public function saveAnimeFromPost(){

        $id = $_POST["anime-id"];
        $name = $_POST["anime-name"];


        $query="INSERT INTO `anime` (anime_name)";
        $query.=" VALUES (?)";
        if($id > 0){

            $query="UPDATE `anime`";
            $query.="SET `anime_name`= ?";
            $query.=" WHERE `anime_id`= ?";

        }

        if ($stmt = $this->mysqli->prepare($query)) {

            if($id > 0){

                $stmt->bind_param('si', $name, $id);
            }else{
                $stmt->bind_param('s', $name);
            }

            $stmt->execute();
            $stmt->close();

            return true;

        }

        return false;
    }

    private function slug($str)
    {
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
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
        LEFT JOIN `anime`
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
        $order=" ORDER BY `character`.`character_name`";

        if(isset($args["order"])){
            $order=" ORDER BY `".$args["order"]."`";
        }

        $query.= $order.$limit. ';';



        return $query;

    }





    function __construct(MysqlConfig $config){
        $this->mysqli = new \mysqli($config->host,$config->username, $config->password,$config->database);

    }


} 