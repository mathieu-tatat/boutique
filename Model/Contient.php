<?php

require_once 'Model/Model.php';

Class Contient extends Model
{
    public $id_produit, $id_panier, $quantite;

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
}