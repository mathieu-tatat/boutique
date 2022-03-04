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
    $targetPath = 'View/ProductImg/';
    $filename = substr($_POST['nom_produit'],0,10);
    $targetFile = $targetPath.$filename.'.jpg';
    move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
    $nom = $_POST['nom_produit'];
    $prix = $_POST['unit_price'];
    $uniteEnStock = $_POST['units_in_stock'];
    $description = $_POST['description'];
    $idCategorie = $_POST['id_categorie'];
    $idSousCategorie = $_POST['id_sous_categorie'];
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
    $nom = $_POST["nom_produit"];
    $prix = $_POST["unit_price"]; 
    $uniteEnStock = $_POST["units_in_stock"]; 
    $description = $_POST["description"];
    $idCategorie = $_POST["id_categorie"]; 
    $idSousCategorie = $_POST["id_sous_categorie"];
    $idProduit = $_POST["id_produit"];
    $produit->updateProduit($nom, $prix, $uniteEnStock, $description, $idCategorie, $idSousCategorie, $idProduit);    
}

//chg img
if(isset($_POST['chg_img']))
{
    $targetPath = 'View/ProductImg/';
    $filename = substr($_POST['nom_produit'],0,10);
    $targetFile = $targetPath.$filename.'.jpg';
    $idProduit = $_POST["id_produit"];
    move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
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