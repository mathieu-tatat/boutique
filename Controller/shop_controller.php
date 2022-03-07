<?php 
include_once ('Model/Produit.php');
require_once ('Model/Categorie.php');
require_once ('Model/SousCategorie.php');
$produit = new Produits();
$categorie = new Categorie();
$sousCategorie = new SousCategorie();
$items;

/*-----------------------------
            CREATE
-----------------------------*/  
if(isset($_POST['create_prod']))
{
    //recupération du nom de produit et détermination de l'endroit ou stocker l'image uploadée
    $targetPath = 'View/ProductImg/';
    $filename = substr($_POST['nom_produit'],0,10);
    $targetFile = $targetPath.$filename.'.jpg';

    //transfert de l'image vers l'endroit
    move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);

    //récupération des données renseignées dans le formulaire
    $nom = $_POST['nom_produit'];
    $prix = $_POST['unit_price'];
    $uniteEnStock = $_POST['units_in_stock'];
    $description = $_POST['description'];
    $idCategorie = $_POST['id_categorie'];
    $idSousCategorie = $_POST['id_sous_categorie'];

    //création du produit dans la base de donnée
    $produit->createProduit($nom, $targetFile, $prix, $uniteEnStock, $description, $idCategorie, $idSousCategorie);
}

/*-----------------------------
        CREATE CATEGORIE
-----------------------------*/
if(isset($_POST['createCategorie']))
{
    $nom = $_POST['nomCategorie'];

    $categorie->createCategorie($nom);
}


/*-----------------------------
    CREATE SOUS-CATEGORIE
-----------------------------*/
if(isset($_POST['createSousCategorie']))
{
    $nom = $_POST['nomSousCategorie'];
    $idCategorie = $_POST['id_categorie'];

    $sousCategorie->createSousCategorie($nom, $idCategorie);

}


/*-----------------------------
               UPDATE
-----------------------------*/
// chg txt data  
if(isset($_POST['update_prod']))
{
    //récupération des données renseignées dans le formulaire
    $nom = $_POST["nom_produit"];
    $prix = $_POST["unit_price"]; 
    $uniteEnStock = $_POST["units_in_stock"]; 
    $description = $_POST["description"];
    $idCategorie = $_POST["id_categorie"]; 
    $idSousCategorie = $_POST["id_sous_categorie"];
    $idProduit = $_POST["id_produit"];

    //update du produit dans la base de donnée
    $produit->updateProduit($nom, $prix, $uniteEnStock, $description, $idCategorie, $idSousCategorie, $idProduit);    
}

//chg img
if(isset($_POST['chg_img']))
{
    //recupération du nom de produit et détermination de l'endroit ou stocker l'image uploadée
    $targetPath = 'View/ProductImg/';
    $filename = substr($_POST['nom_produit'],0,10);
    $targetFile = $targetPath.$filename.'.jpg';
    
    //transfert de l'image vers l'endroit
    move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);

    //récupération des données renseignées dans le formulaire
    $idProduit = $_POST["id_produit"];

    //update de l'image du produit dans la base de donnée
    $produit->updateImg($targetFile, $idProduit);
}


/*---------------------------
            GESTION VUE
----------------------------*/
if(isset($_GET['id_sous_categorie']))
{
    $items = $produit->getAllProductsBySubCatId($_GET['id_sous_categorie']);
    require_once('View/shopDefault.php');
}
elseif(isset($_GET['id_categorie']))
{
    $items = $produit->getAllProductsByCatId($_GET['id_categorie']);
    require_once('View/shopDefault.php');
}
elseif(isset($_GET['searchBarIn']))
{
    $items = $produit->getProductsBySearch($_GET['searchBarIn']);
    require_once('View/shopDefault.php');
}
elseif(isset($_GET['article_id']))
{
    
    if(isset($_SESSION["droits"]) && $_SESSION["droits"] == 1337)
    {
        require_once('View/shopArticleAdmin.php');
    }
    else
    {
        require_once('View/shopArticle.php');
    }

}
elseif(isset($_GET['addProduit']))
{
    if(isset($_SESSION["droits"]) && $_SESSION["droits"] == 1337)
    {
        require_once('View/shopArticleAdd.php');
    }
    else
    {
        $items = $produit->getAllProductWithCatAndSubCat();
        require_once('View/shopDefault.php');
    }
}
else
{
    $items = $produit->getAllProductWithCatAndSubCat();
    require_once('View/shopDefault.php');
}