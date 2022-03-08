<?php

require_once('Model.php');

Class Cart extends Db
{
    public $id_panier, $id_utilisateur, $total;

    function __construct()
    {
    }

    public function getCart($id_utilisateur){
        $sql = " SELECT id_panier FROM paniers WHERE id_utilisateur=:id_utilisateur ORDER BY id_panier DESC";
        $params = [':id_utilisateur' => $id_utilisateur];
        $result = $this->selectQuery($sql, $params);
        $id_panier=$result->fetch();
        return $id_panier;
    }
    public function insertCart($id_utilisateur){
        $sql = " INSERT INTO paniers(id_utilisateur) VALUES (:id_utilisateur) ";
        $params = ([':id_utilisateur' => $id_utilisateur]);
        $this->selectQuery($sql, $params);
    }

}