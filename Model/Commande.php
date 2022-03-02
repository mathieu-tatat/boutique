<?php

require_once 'Model/Model.php';

Class Commande extends Model
{
    public $id_panier, $id_utilisateur;

    function __construct(){}

    public function getCommande($id_panier)
    {
        $sql = " SELECT * FROM commandes WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }

    public function getAllCmds()
    {
        $sql ="SELECT commandes.id_commande, commandes.date_commande,
                        paiements.nom_paiement,
                        SUM(produits.unit_price*contient.quantité) AS total_price,
                        utilisateurs.prenom, utilisateurs.nom, utilisateurs.email
                        FROM commandes
                        INNER JOIN paiements        ON commandes.id_paiement = paiements.id_paiement
                        INNER JOIN paniers          ON commandes.id_panier = paniers.id_panier
                        INNER JOIN contient         ON paniers.id_panier = contient.id_panier
                        INNER JOIN produits         ON contient.id_produit = produits.id_produit
                        INNER JOIN categories       ON produits.id_categorie = categories.id_categorie
                        INNER JOIN sous_categories  ON produits.id_sous_categorie = sous_categories.id_sous_categorie
                        INNER JOIN utilisateurs     ON paniers.id_utilisateur = utilisateurs.id_utilisateur
                        GROUP BY commandes.id_commande;";

        $result = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}