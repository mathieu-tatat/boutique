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

    public function createCategorie($nom)
    {
        $sql = "INSERT INTO categories (id_categorie, nom_categorie)
                VALUES (NULL,?)";

        $params = array($nom);

        $this->selectQuery($sql, $params);
    }

}