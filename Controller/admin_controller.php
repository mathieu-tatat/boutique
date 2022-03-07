<?php
include_once ('Model/Carousel.php');
include_once ('Model/Produit.php');
$carousel = new Carousel();
$produit = new Produits();

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
    $soustitre = "Bienvenu sur la page admin"; 
    ob_start(); ?>        
        <h4 class="text-center">Veuillez choisir</h4>
<?php   $souscontenu = ob_get_clean(); 
} ?>