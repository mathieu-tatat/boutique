<?php

require_once('Model/Contient.php');

// Models :  User  &  Cart  &  Contient  &  Produit   __________________________________________________________________

if(isset($_SESSION['connected'])){
    $email=$_SESSION['connected'];
    $user= new User();  //new user to get my infos
    // INFOS________________________________________________________________________________________________________
    $id=$user->getId($email);   //get id_utilisateur to get all my infos
    $user_infos=$user->getUserInfos($id['id_utilisateur']); // get all my infos for placeholders
    // CART_________________________________________________________________________________________________________
    $cart=new Cart();   //new cart to exploit panier et cart in bd


    $id_cart=$cart->getCart($id['id_utilisateur']); // get my panier id



    $contient=new Contient($id_cart['id_panier']);  // instantiate a object content for cart with the panier id
    $full_cart=$contient->getContient($id_cart['id_panier']);    // get the panier content
    $products=new Produits();   // instantiate newproduct to get products from db
    foreach($full_cart as $key => $content){    // foreach indexed content of full_cart
        $products_infos[]=$products->getProduitsFromId($content['id_produit']); //get prod info as stack
        $quantity[]=$content['quantite'];   //get prod quantity as stack
    }
} else {
    header('location:connexion.php');   // if the session doesn't exists back to log in
    exit();
}

if(isset($_POST['submitCartUpdate'])){  //if the quantity add button is pressed:
    $id_panier=$id_cart['id_panier'];   // get my id panier
    $details=explode(',',$_POST['selectQuant']);
    $quantite=$details[0];
    $id_produit=$details[1];
    $contient=new Contient();
    $exist=$contient->getQuantity(intval($id_panier),intval($id_produit));
    if(intval($quantite)!==0){
        if(empty($exist)){
            $quantite=1;
            $contient->addToContient(intval($id_panier),$quantite,intval($id_produit));
            header('location: cart.php');
        } else {
            $contient->addMultipleQuantityToContient(intval($quantite),intval($id_panier),intval($id_produit));
            header('location: cart.php');
        }
    } else{
        $contient->deleteContientRow(intval($id_panier), intval($id_produit));
        header('location: cart.php');
    }
}

if(isset($_POST['submitProductDelete'])){
    $id_panier=$id_cart['id_panier'];
    $id_produit=$_POST['submitProductDelete'];
    $contient->deleteContientRow(intval($id_panier), intval($id_produit));
    header('location: cart.php');
}

if(isset($_POST['payCart'])){
    $total=new Contient();
    $total=$total->totalContient($_SESSION['cart']);
    $_SESSION['totalcart']=intval($_POST['payCart']);
    //header('location:paiement/paiements.php');
}