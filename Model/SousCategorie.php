<?php 

require_once 'Model/Model.php';

Class SousCategorie extends Model
{
    function __construct(){}

    public function getAllSubCat()
    {
        $sql = "SELECT * FROM sous_categories";

        $infos = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $infos;

    }
    
}