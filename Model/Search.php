<?php

require_once 'Model/Model.php';

Class Search extends Model
{

    function __construct(){}

    public function searchAll($search)
    {
        $sql = "SELECT * FROM produits WHERE INSTR(* , :search )";

        $params = ['search' => $search];

        $result = $this->selectQuery($sql, $params);

        $search_result=$result->fetchAll();
        
        return $search_result;
    }
}
