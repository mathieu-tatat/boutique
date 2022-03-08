<?php

require_once ('Model.php');

Class currentProduct extends Db
{
    public $id_produit,$unit_price,$quantite;

    function __construct()
    {
    }
    function __set($name,$value)
    {
        $this->name= $value;
    }

    public function __get($name)
    {
        return $this->name;
    }

}
