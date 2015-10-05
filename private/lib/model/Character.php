<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 10:03 PM
 */

namespace model;
use \data\AbstractAdapter;


class Character {

    public $id;
    public $name;
    public $imageSrc;
    public $quotes;

    public function getParentAnime(){

    }

    public function refresh(AbstractAdapter $dataSource){
        $row = $dataSource->query("SELECT * FROM USER WHERE `user_id` = $this->id;");

    }

    /**
     * @param $id
     * @param $name
     * @param $quotes
     * @param $imageSrc
     */
    function __construct($id, $name, $quotes, $imageSrc){
        $this->id = $id;
        $this->name = $name;
        $this->$quotes = $quotes;
        $this->imageSrc = $imageSrc;
    }





} 