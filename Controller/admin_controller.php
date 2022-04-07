<?php
include_once ('Model/Carousel.php');
include_once ('Model/Produit.php');
require_once ('Model/Categorie.php');
require_once ('Model/SousCategorie.php');
$carousel = new Carousel();
$produit = new Produits();
$categorie = new Categorie();
$sousCategorie = new SousCategorie();

/*---------------------------
        GESTION CAROUSEL
----------------------------*/
if(isset($_POST["objet1"]))
{
    $carousel->updateToCarousel($_POST['idProduit'],1);
}

if(isset($_POST["objet2"]))
{
    $carousel->updateToCarousel($_POST['idProduit'],2);
}

if(isset($_POST["objet3"]))
{
    $carousel->updateToCarousel($_POST['idProduit'],3);
}

if(isset($_POST["objet4"]))
{
    $carousel->updateToCarousel($_POST['idProduit'],4);
}


/*---------------------------
            GESTION VUE
----------------------------*/

if(isset($_POST["gestion_user"]))
{
    require_once('View/adminUser.php');
}
elseif (isset($_POST["gestion_produit"]))
{
    require_once('View/adminProduit.php');
}
elseif (isset($_POST["gestion_commande"]))
{
    require_once('View/adminCommande.php');
}
else
{
    $soustitre = "Bienvenue sur la page admin"; 
    ob_start(); ?>        
        <h4 class="text-center">Veuillez choisir une option :</h4>
<?php   $souscontenu = ob_get_clean(); 
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