<?php
/**
 * Created by PhpStorm.
 * User: Mick
 * Date: 5/28/15
 * Time: 9:03 PM
 */

namespace data;


use config\MysqlConfig;

abstract class AbstractAdapter {

    abstract public function getAllCharacters();
    abstract public function getMenu();
    abstract public function getCharacterByAlias($alias);
    abstract public function getQuotesByCharacterId($id);


} 