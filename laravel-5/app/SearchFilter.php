<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 21/05/2015
 * Time: 14:34
 */

namespace App;


class SearchFilter {

    public $sql;

    public function __Construct($sql=""){
        $this->sql = $sql;
    }
} 