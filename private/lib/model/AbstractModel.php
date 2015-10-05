<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/29/15
 * Time: 1:10 AM
 */

namespace model;


class AbstractModel {

    public $id, $timeCreated;


    function __construct($id, $timeCreated){

        $this->id = $id;
        $this->timeCreated = $timeCreated;

    }

} 