<?php

require_once('Model/Article.php');
require_once('Model/Produits.php');
require_once('Model/Contient.php');
require_once('Model/User.php');
require_once('Model/Search.php');
require_once('Model/Categorie.php');
require_once('Model/SousCategorie.php');

// creation de mes produits
$article = new Produits();
// gegt infos from products
$items = $article->get_info_produits();

//instantiate a new user
$user=new User();

if(isset($_SESSION['connected'])){
    $id=$_SESSION['id'];
} else {
    if(isset($_POST['addToCart']) or isset($_POST['quantity'])){
        header('location:connexion.php');
    }
}

// if cart is pressed or quantity is chaged and you're connected (for now...)
if((isset($_POST['addToCart'])  or isset($_POST['quantity'])) and isset($_SESSION['connected'])) {

    // get my cart id
    $id_panier = $_SESSION['cart'];

    $id_panier = intval($id_panier);//format
    $quantite = intval($_POST['quantity']);//format
    $id_produit = intval($_POST['addToCart']);//format

    // get a new content
    $contient = new Contient();
    //check for existing contient
    $exist = $contient->getQuantity($id_panier, $id_produit);

    // if it doesn't exists
    if (empty($exist)) {
        // if the selected quantity is different than 0
        if ($quantite !== 0) {
            // add product in Db / create a new row in Contient
            $contient->addToContient($id_panier, $quantite, $id_produit);
            // add multiple products
            $contient->addMultipleQuantityToContient($quantite, $id_panier, $id_produit);

        } else {   // if the quantity is 0 and just the 'add to cart' is pressed
            // add one to quantity
            $quantite = $quantite + 1;
            // add it in Db contient
            $contient->addToContient($id_panier, $quantite, $id_produit);
        }

    } else {    // if it exists
        // if quantity equal to 0
        if ($quantite === 0) {
            // delete the row from Contient in Db
            $contient->deleteContientRow($id_panier, $id_produit);

        } else {

            $contient->addMultipleQuantityToContient($quantite, $id_panier, $id_produit);
        }
    }
}

// shop Views controller and Admin shop controller
//
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
    $targetPath = 'Elements/ProductImg/';
    $filename = substr($_POST['nom_produit'],0,10);
    $targetFile = $targetPath.$filename.'.jpg';
    $idProduit = $_POST["id_produit"];
    move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
    var_dump($_FILES);
    $produit->updateImg($targetFile, $idProduit);
}


/*---------------------------
            GESTION VUE
----------------------------*/
if(isset($_GET['id_sous_categorie']))
{
    $items = $produit->getAllProductsBySubCatId($_GET['id_sous_categorie']);
    require_once('./View/shopDefault.php');
}
elseif(isset($_GET['id_categorie']))
{
    $items = $produit->getAllProductsByCatId($_GET['id_categorie']);
    require_once('./View/shopDefault.php');
}
elseif(isset($_GET['searchBarIn']))
{
    $items = $produit->getProductsBySearch($_GET['searchBarIn']);
    require_once('./View/shopDefault.php');
}
elseif(isset($_GET['article_id']))
{

    if(isset($_SESSION["droits"]) && $_SESSION["droits"] == 1337)
    {
        require_once('./View/shopArticleAdmin.php');
    }
    else
    {
        require_once('./View/shopArticle.php');
    }

}
elseif(isset($_GET['addProduit']))
{
    if(isset($_SESSION["droits"]) && $_SESSION["droits"] == 1337)
    {
        require_once('./View/shopArticleAdd.php');
    }
    else
    {
        $items = $produit->getAllProductWithCatAndSubCat();
        require_once('./View/shopDefault.php');
    }
}
else
{
    $items = $produit->getAllProductWithCatAndSubCat();
    require_once('./View/shopDefault.php');
}


?>