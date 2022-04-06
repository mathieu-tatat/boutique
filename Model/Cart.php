<?php 

require_once 'Model/Model.php';

Class Cart extends Model
{
    public  $id_panier, 
            $id_utilisateur;

    function __construct() {}

    public function getCart($id_utilisateur)
    {
        $sql = "SELECT id_panier 
                FROM paniers 
                WHERE id_utilisateur=:id_utilisateur ";

        $params = ['id_utilisateur' => $id_utilisateur];
        $result = $this->selectQuery($sql, $params);
        $id_panier=$result->fetchAll(PDO::FETCH_ASSOC);
        return $id_panier;
    }

    public function createCart($id_utilisateur)
    {
        $sql ="INSERT INTO paniers (id_panier, id_utilisateur)
                VALUES (NULL, ?)";
        $params = [$id_utilisateur];

        $register = $this->selectQuery($sql, $params);

        return $register;     
        
    }
}