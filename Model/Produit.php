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
    
    public function get_info_produits()
    {
        $conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // prepare la recuperation des infos de tout les produits 
        $req = $conn->prepare("SELECT * FROM Produits order by id_produit DESC");
        //execute la requete
        $req->execute();
        
        $produits = $req->fetchAll();

        return $produits;    
    }

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

    public function updateProduit()
    {
        $sql = "UPDATE produits 
                SET nom_produit = ?,
                unit_price = ?, units_in_stock = ?,
                description_produit = ?,
                id_categorie = ?, id_sous_categorie = ?                    
                WHERE `id_produit` = ?";

        $params = array($_POST["nom_produit"],
                        $_POST["unit_price"], $_POST["units_in_stock"], 
                        $_POST["description_produit"],
                        $_POST["id_categorie"], $_POST["id_sous_categorie"],
                        $_POST["id_produit"]);

        $updateQuery = $this->selectQuery($sql, $params);

        return $updateQuery;
    }

    public function getAllProductWithCatAndSubCat()
    {
        $sql="SELECT produits.*, categories.nom_categorie, sous_categories.nom_sous_categorie
                FROM produits
                INNER JOIN categories       ON produits.id_categorie = categories.id_categorie
                INNER JOIN sous_categories    ON produits.id_sous_categorie = sous_categories.id_sous_categorie";

        $result = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}