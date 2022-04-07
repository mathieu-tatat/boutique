<?php 
include_once ('Model/Produit.php');
require_once ('Model/Categorie.php');
require_once ('Model/SousCategorie.php');
require_once('Model/User.php');
require_once('Model/Search.php');
require_once('Model/Categorie.php');
require_once('Model/SousCategorie.php');
require_once('Model/Contient.php');

$produit = new Produits();
$categorie = new Categorie();
$sousCategorie = new SousCategorie();
$user=new User();
$items;


if(isset($_SESSION['connected'])){
    $id=$_SESSION['id'];
} else {

    // cart message for user not connected
    if(isset($_POST['addToCart']) or isset($_POST['quantity'])){

        $_SESSION['new_user'] = true;
        header('location:connexion.php');
    }
}

// if cart is pressed or quantity is chaged and you're connected (for now...)
if(isset($_POST['addToCart']) and isset($_SESSION['connected'])) {

    // get my cart id
    $id_panier = $_SESSION['cart']['id_panier'];
    $quantite = intval($_POST['quantity']);     //format
    $id_produit = intval($_POST['idProduit']);  //format

    // get a new content
    $contient = new Contient();
    
    //check for existing contient
    $exist = $contient->getQuantity($id_panier, $id_produit);

    // if it doesn't exists
    if (empty($exist)) {
        // if the selected quantity is different than 0
        if ($quantite !== 0) {
            // add product in Db / create a new row in Contient
            $contient->addToContient($id_panier, $id_produit, $quantite);
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