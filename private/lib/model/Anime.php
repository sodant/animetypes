<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 10:03 PM
 */

namespace model;

require("AbstractModel.php");

class Anime extends AbstractModel{

    public $password;

    public function getAllCharacters(){

    }

    function __construct($id,$timecreated){
        parent::__construct($id,$timecreated);

    }

} 