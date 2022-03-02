<?php
if(isset($_POST['update_prod']))
{
    $prod=new Produits($_POST["nom_produit"],
        $_POST["unit_price"], $_POST["units_in_stock"],
        $_POST["description_produit"],
        $_POST["id_categorie"], $_POST["id_sous_categorie"],
        $_POST["id_produit"]);

    $_POST['gestion_produit'] = "";
}