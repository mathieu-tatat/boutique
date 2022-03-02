<?php

if(isset($_SESSION['connected'])){
    $email=$_SESSION['connected'];
    $user= new User();
    $id= $user->getAllUserInfos($email);
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
    // ORDERS_______________________________________________________________________________________________________
    $orders=$user->getAllOrders($id['id_utilisateur']);
} else {
    header('location:connexion.php');   // if the session doesn't exists
    exit();
}

if(isset($_SESSION['commande_details'])){
    $id_comm=$_SESSION['commande_details'];    //choppe id_panier
    $commandes=new Commande();
    $comm=$commandes->getAllProductsOneCommande($id_comm);
    //var_dump($comm);

}