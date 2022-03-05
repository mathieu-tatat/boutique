<?php

require_once ('Model.php');

class Article extends Db{
    // Méthodes

    public function __construct() { }

    public function get_article_details($id_produit){

        //prepare la recuperation toutes les infos du produit recuperés en get
        $sql = "SELECT * FROM produits  WHERE id_produit = :id_produit";
        //execute la requete
        $params = [':id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $produit=$result->fetchAll();
        return $produit;
    }
}