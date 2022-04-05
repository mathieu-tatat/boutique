<?php

if(!isset($_SESSION['connected']))
{
    header('location:connexion.php');  // if the hash doesn't match
    exit();
}

// Models:  User  &  Cart  &  Contient  &  Produits  &  Commande ______________________________________________________________

if(isset($_SESSION['connected'])){
    $email=$_SESSION['connected'];
    $user = new User();

    // CART_________________________________________________________________________________________________________
    $cart=new Cart();
    $id_cart=$cart->getCart($_SESSION['id']); // get my panier id

    $contient=new Contient($id_cart[0]['id_panier']);  // instantiate a object content for cart with the panier id
    $full_cart=$contient->getContient($id_cart[0]['id_panier']);    // get the panier content
    $products=new Produits();
    foreach($full_cart as $key => $value){
        $products_infos[]=$products->getProduitsFromId($value['id_produit']);
        $quantity[]=$value['quantité'];
    }
    // ORDERS_______________________________________________________________________________________________________
    $orders=$user->getAllOrders($_SESSION['id']);
} else {
    header('location:connexion.php');   // if the session doesn't exists
    exit();
}

if(isset($_SESSION['commande_details'])){
    $id_comm = $_SESSION['commande_details'];    //choppe id_panier
    $commandes = new Commande();
    $comm=$commandes->getAllProductsOneCommande($id_comm);

}