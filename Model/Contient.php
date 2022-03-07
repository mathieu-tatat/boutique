<?php

require_once 'Model/Model.php';

Class Contient extends Model
{
    public $id_produit, $id_panier, $quantite;

    function __construct(){}

    public function getContient($id_panier)
    {
        $sql = " SELECT * FROM contient WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }

    public function addToContient($id_panier, $id_produit, $quantite)
    {

        $sql = " INSERT INTO contient (id_panier, id_produit, quantité) 
                    VALUES (?, ?, ?)";

        $params = array($id_panier, $id_produit, $quantite);

        $this->selectQuery($sql, $params);

    }

    public function getQuantity($id_panier,$id_produit){
        $sql="SELECT quantité FROM contient WHERE id_panier=:id_panier AND id_produit = :id_produit";
        $params = [':id_panier' =>$id_panier,':id_produit' => $id_produit];
        $result=$this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }

    public function addQuantityToContient($id_panier,$id_produit)
    {
        $sql="UPDATE contient 
                SET quantité = quantité + 1 
                WHERE id_produit = ? AND id_panier = ?";
        $params = array($id_produit, $id_panier);
        $result=$this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }

    public function addMultipleQuantityToContient($quantité,$id_panier,$id_produit){
        $sql = " UPDATE contient SET quantité = ? WHERE id_panier = ? AND id_produit = ? ";
        $params= array($quantité, $id_panier, $id_produit);
        $this->selectQuery($sql, $params);
    }

    public function deleteContientRow($id_panier,$id_produit){
        $sql = "DELETE FROM contient WHERE id_panier = :id_panier AND id_produit = :id_produit ";
        $params=([':id_panier' => $id_panier, ':id_produit' => $id_produit]);
        $this->selectQuery($sql, $params);
    }

    public function totalContient($id_panier){
        $sql = " SELECT contient.id_produit, contient.quantité, contient.id_panier,
                        produits.unit_price*contient.quantité as total
                produits.unit_price
                INNER JOIN produits
                ON contient.id_produit = produits.id_produit
                FROM contient WHERE id_panier=:id_panier ";
        $params = [':id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $total=$result->fetchAll();
        return $total;
    }

}