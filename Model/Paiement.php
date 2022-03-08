<?php 

require_once 'Model/Model.php';

Class Paiement extends Model
{
    public $id_panier, $id_utilisateur;

    function __construct(){}

    public function createCBPayment($idPanier)
    {
        $sql = "INSERT INTO commandes (id_commande, date_commande, id_panier, id_paiement)
                VALUES (NULL, NOW(), ?, 1)";

        $params = array($idPanier);

        $this->selectQuery($sql, $params);
    }
}