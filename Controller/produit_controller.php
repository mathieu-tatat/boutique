<?php
    include_once ('Model/Produit.php');
    $produit = new Produits();

    if(isset($_POST['update_prod']))
    {
           $produit->updateProduit();    
    }