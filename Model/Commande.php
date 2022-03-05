<?php

require_once ('Model.php');

Class Commande extends Db
{
    public $id_panier, $id_utilisateur;

    function __construct()
    {
    }
    public function getCommande($id_panier){
        $sql = " SELECT * FROM commandes WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
    public function getAllProductsOneCommande($id_commande){
        $sql=" SELECT commandes.id_commande,commandes.date_commande,commandes.id_panier,commandes.id_paiement,
                    contient.id_panier, contient.id_produit, contient.quantite,
                    produits.id_produit,produits.nom_produit,produits.unit_price, produits.img_url,
                    paiements.id_paiement,paiements.nom_paiement,
                    SUM(contient.quantite*produits.unit_price) AS price
                    FROM commandes
                    JOIN contient
                     ON commandes.id_panier = contient.id_panier
                    JOIN produits
                     ON contient.id_produit = produits.id_produit
				    JOIN paiements
                     ON paiements.id_paiement = commandes.id_paiement
                     WHERE commandes.id_commande = :id_commande GROUP BY produits.id_produit ORDER BY commandes.date_commande DESC ";
        $params = ['id_commande' => $id_commande];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }

    public function getAllCmds()
    {
        $sql ="SELECT commandes.id_commande, commandes.date_commande,
                        paiements.nom_paiement,
                        SUM(produits.unit_price*contient.quantite) AS total_price,
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
