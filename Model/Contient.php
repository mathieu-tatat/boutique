<?php

require_once ('Model.php');

Class Contient extends Db
{
    public $id_panier, $quantite;

    function __construct()
    {
    }

    public function getContient($id_panier){
        $sql = " SELECT * FROM contient WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
    public function addToContient($id_panier,$quantite,$id_produit){
        $sql = " INSERT INTO contient(id_panier,quantite,id_produit) VALUES (:id_panier,:quantite,:id_produit) ";
        $params = [':id_panier' => $id_panier,':quantite'=>$quantite,':id_produit' => $id_produit];
        $this->selectQuery($sql, $params);
    }
    public function getQuantity($id_panier,$id_produit){
        $sql="SELECT quantite FROM contient WHERE id_panier=:id_panier AND id_produit = :id_produit";
        $params = [':id_panier' =>$id_panier,':id_produit' => $id_produit];
        $result=$this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
    public function addQuantityToContient($id_panier,$id_produit){
        $sql="UPDATE contient SET quantite = quantite + 1 WHERE id_produit = :id_produit AND id_panier = :id_panier";
        $params = [':id_panier' =>$id_panier,':id_produit' => $id_produit];
        $result=$this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
    public function addMultipleQuantityToContient($quantite,$id_panier,$id_produit){
        $sql = " UPDATE contient SET quantite = :quantite WHERE id_panier = :id_panier AND id_produit = :id_produit ";
        $params=([':quantite' => $quantite, ':id_panier' => $id_panier, ':id_produit' => $id_produit]);
        $this->selectQuery($sql, $params);
    }
    public function deleteContientRow($id_panier,$id_produit){
        $sql = "DELETE FROM contient WHERE id_panier = :id_panier AND id_produit = :id_produit ";
        $params=([':id_panier' => $id_panier, ':id_produit' => $id_produit]);
        $this->selectQuery($sql, $params);
    }
}
