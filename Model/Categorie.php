<?php 

require_once 'Model/Model.php';

Class Categorie extends Model
{
    function __construct(){}

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";

        $infos = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $infos;
    }

}