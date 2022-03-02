<?php

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