<?php 

require_once 'Model/Model.php';

Class SousCategorie extends Model
{
    function __construct(){}

    public function getAllSubCat()
    {
        $sql = "SELECT sous_categories.*, categories.nom_categorie
                FROM sous_categories
                INNER JOIN categories ON categories.id_categorie = sous_categories.id_categorie";

        $infos = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $infos;

    }


    public function createSousCategorie($nom, $id_categorie)
    {
        $sql = "INSERT INTO sous_categories (id_sous_categorie, id_categorie, nom_sous_categorie)
                VALUES (NULL, ?, ?)";

        $params = array($id_categorie, $nom);

        $this->selectQuery($sql, $params);
    }
    
}