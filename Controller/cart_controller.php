<?php

if(!isset($_SESSION['connected'])){
    header('location:connexion.php');
    exit();
}

if(isset($_SESSION['connected'])){
    $email=$_SESSION['connected'];
    $user= new User();
    // INFOS________________________________________________________________________________________________________
    $id=$user->getId($email);
    $user_infos=$user->getUserInfos($id['id_utilisateur']); // get all my infos for placeholders
    // CART_________________________________________________________________________________________________________
    $cart=new Cart();
    $id_cart=$cart->getCart($id['id_utilisateur']); // get my panier id
    $contient=new Contient($id_cart['id_panier']);  // instantiate a object content for cart with the panier id
    $full_cart=$contient->getContient($id_cart['id_panier']);    // get the panier content
    $products=new Produits();
    foreach($full_cart as $key => $content){
        $products_infos[]=$products->getProduitsFromId($content['id_produit']);
        $quantity[]=$content['quantite'];
    }
} else {
    header('location:connexion.php');   // if the session doesn't exists
    exit();
}