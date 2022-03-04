<?php
// creation de mes produits
$article = new Produits();
$items = $article->get_info_produits();
$user=new User();
$id=$_SESSION['cart']->id_utilisateur;

if(isset($_POST['addToCart']) or isset($_POST['submitContientUpdate'])){
    $id_panier=$_SESSION['cart']->id_panier;
    $id_produit=$_POST['addToCart'];
    $contient=new Contient();
    $exist=$contient->getQuantity(intval($id_panier),intval($id_produit));   //check for existing contient
    var_dump($exist);
    if(empty($exist)){
        $quantite=1;
        $contient->addToContient(intval($id_panier),$quantite,intval($id_produit));
    } else {
        $contient->addQuantityToContient(intval($id_panier),intval($id_produit));
    }
    //$contient->addToContient($id_panier,$quantite,$id_produit);
    /*
    $product=$user->createContent($id_produit);
    array_push($_SESSION['cart']->contenu,array($id_produit=>$product));
    if(in_array($id_produit,$_SESSION['cart']->contenu)){
        var_dump($_SESSION['cart']->contenu);
    } else {
    }
    var_dump($_SESSION['cart']);
    //var_dump($_SESSION['cart']);
    //var_dump($_SESSION['cart']->contenu[0][9]);
    //var_dump($_SESSION['cart']->contenu[0][9]->img_url);
*/

}
?>