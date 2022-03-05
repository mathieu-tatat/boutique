<?php

require_once ('Model.php');

Class CartContientSession extends Db
{
    public $id_panier,$id_utilisateur;
    public $contenu = [];

    function __set($name,$value)
    {
        $this->contenu[$name] = $value;
    }

    public function __get($name)
    {
        return $this->contenu[$name];
    }

    public function addProduct($id_panier,$id_produit,$quantite){
        $sql = " INSERT INTO contient(id_panier,id_produit,quantite) VALUES (:id_panier,:id_produit,quantite) ";
        $params = [':id_panier' => $id_panier,':id_produit' => $id_produit,':quantite' => $quantite];
        $this->selectQuery($sql, $params);
    }
    public function contientDetails($id_panier,$id_produit){
        $sql = " INSERT INTO contient(id_panier,id_produit) VALUES (:id_panier,:id_produit) ";
        $params = [':id_panier' => $id_panier,':id_produit' => $id_produit];
        $this->selectQuery($sql, $params);
    }

}
