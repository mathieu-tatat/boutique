<?php 

require_once 'Model/Model.php';

class Produits extends Model
{
    public  $id_produit, 
            $nom_produit, 
            $img_url , 
            $unit_price, 
            $description_produit, 
            $units_in_stock,
            $id_categorie, 
            $id_sous_categorie;

    public function __construct() {}

    public function getProduitsFromId($id_produit)
    {
        $sql = " SELECT * FROM produits WHERE id_produit=:id_produit ";
        $params = ['id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $contient = $result->fetch();
        return $contient;
    }

    public function getQuantityFromId($id_produit){
        $sql = " SELECT quantite FROM produits WHERE id_produit=:id_produit ";
        $params = ['id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $contient = $result->fetch();
        return $contient;
    }

    public function updateProduit($nom, $prix, $uniteEnStock, $description, $idCategorie, $idSousCategorie, $idProduit)
    {
        $sql = "UPDATE produits 
                SET nom_produit = ?,
                unit_price = ?, units_in_stock = ?,
                description_produit = ?,
                id_categorie = ?, id_sous_categorie = ?                    
                WHERE `id_produit` = ?";

        $params = array($nom, $prix, $uniteEnStock, $description, $idCategorie, $idSousCategorie, $idProduit);

        $updateQuery = $this->selectQuery($sql, $params);

        return $updateQuery;
    }

    public function updateImg($imgUrl, $idProduit)
    {
        $sql = "UPDATE produits
                SET img_url = ?
                WHERE `id_produit` = ?";

        $params = array($imgUrl, $idProduit);

        $this->selectQuery($sql, $params);
    }

    public function createProduit($nom, $imgUrl, $prix, $uniteEnStock, $description, $categorie, $souscategorie)
    {
        $sql = "INSERT INTO produits (nom_produit, img_url, unit_price, 
                                        description_produit, units_in_stock, 
                                        id_categorie, id_sous_categorie)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $params = array($nom, $imgUrl, $prix,
                            $description, $uniteEnStock,
                            $categorie, $souscategorie);

        $this->selectQuery($sql,$params);        
    }

    public function getAllProductWithCatAndSubCat()
    {
        $sql="SELECT produits.*, categories.nom_categorie, sous_categories.nom_sous_categorie
                FROM produits
                INNER JOIN categories           ON produits.id_categorie = categories.id_categorie
                INNER JOIN sous_categories      ON produits.id_sous_categorie = sous_categories.id_sous_categorie";

        $result = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllProductsByCatId($id)
    {
        $sql="SELECT *
                FROM produits
                WHERE id_categorie = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getAllProductsBySubCatId($id)
    {
        $sql="SELECT *
                FROM produits
                WHERE id_sous_categorie = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }


    public function getProductsBySearch($search)
    {
        $sql = "SELECT produits.*, categories.nom_categorie, sous_categories.nom_sous_categorie 
        FROM produits 
        INNER JOIN categories ON produits.id_categorie = categories.id_categorie 
        INNER JOIN sous_categories ON produits.id_sous_categorie = sous_categories.id_sous_categorie 
        WHERE CONCAT(produits.nom_produit, produits.description_produit, 
        categories.nom_categorie, sous_categories.nom_sous_categorie) 
        LIKE ?;";

        $params = array("%".$search."%");

        $result = $this->selectQuery($sql, $params);

        $search_result=$result->fetchAll();
        
        return $search_result;
    }

    public function getImgById($id)
    {
        $sql = "SELECT img_url FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['img_url'];

    }

    public function getNomById($id)
    {
        $sql = "SELECT nom_produit FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['nom_produit'];

    }

    public function getUnitsInStockById($id)
    {
        $sql = "SELECT units_in_stock FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['units_in_stock'];

    }

    public function getUnitPriceById($id)
    {
        $sql = "SELECT unit_price FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['unit_price'];

    }

    public function getDescriptionById($id)
    {
        $sql = "SELECT description_produit FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['description_produit'];

    }

    public function getCategorieById($id)
    {
        $sql = "SELECT id_categorie FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['id_categorie'];
    }

    public function getSousCategorieById($id)
    {
        $sql = "SELECT id_sous_categorie  FROM produits WHERE id_produit = ?";

        $params = array($id);

        $result = $this->selectQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);

        return $result['id_sous_categorie'];
    }


    public function deleteProductById ($idProduit)
    {
        $sql = "DELETE FROM Produits
                where id_produit = ?";
        
        $params = array($idProduit);

        $this->selectQuery($sql, $params);
        
    }
    


}