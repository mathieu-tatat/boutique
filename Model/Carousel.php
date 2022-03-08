<?php 

require_once 'Model/Model.php';

class Carousel extends Model {

    public function updateToCarousel($idProduit, $idCarousel)
    {
        $sql="UPDATE carousel_produits 
        SET id_produit = ?                    
        WHERE `id_produit_carousel` = ?";

        $params = array($idProduit, $idCarousel);

        $this->selectQuery($sql, $params);
    }


    public function getProduitIdById($idCarousel)
    {
        $sql= "SELECT id_produit
        FROM carousel_produits
        WHERE id_produit_carousel = ?";

        $params = array($idCarousel);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllProductsInCarousel()
    {
        $sql = "SELECT carousel_produits.id_produit_carousel, produits.*, categories.nom_categorie, sous_categories.nom_sous_categorie 
        FROM carousel_produits
        INNER JOIN produits ON carousel_produits.id_produit = produits.id_produit 
        INNER JOIN categories ON produits.id_categorie = categories.id_categorie 
        INNER JOIN sous_categories ON produits.id_sous_categorie = sous_categories.id_sous_categorie;";

        $result = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}