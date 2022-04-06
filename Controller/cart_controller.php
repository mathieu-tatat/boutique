<?php

require_once('Model/Contient.php');

// Models :  User  &  Cart  &  Contient  &  Produit   __________________________________________________________________

if(isset($_SESSION['connected'])){
    $email=$_SESSION['connected'];
    
    //new user to get my infos
    $user= new User();

    // INFOS________________________________________________________________________________________________________

    $user_infos=$user->getUserInfos($_SESSION["id"]); // get all my infos for placeholders

    // CART_________________________________________________________________________________________________________
    
    //new cart to exploit panier et cart in bd
    $cart = new Cart();
    
    // get my panier id
    $id_cart = $cart->getCart($_SESSION["id"]);
    
    // instantiate a object content for cart with the panier id
    $contient = new Contient($_SESSION['cart']['id_panier']);
    
    // get the panier content
    $full_cart = $contient->getContient($_SESSION['cart']['id_panier']); 
    
    // instantiate newproduct to get products from db
    $products = new Produits();
    
    // foreach indexed content of full_cart
    foreach($full_cart as $key => $content)
    {    
        //get prod info as stack
        $products_infos[]=$products->getProduitsFromId($content['id_produit']); 

        //get prod quantity as stack
        $quantity[]=$content['quantité'];   
    }
} 
else 
{
    // if the session doesn't exists back to log in
    header('location:connexion.php');   
    exit();
}


//if the quantity add button is pressed:
if(isset($_POST['submitCartUpdate']))
{  
     // get my id panier
    $id_panier=$_SESSION['cart']['id_panier'];  
    $details=explode(',',$_POST['selectQuant']);
    $quantite=$details[0];
    $id_produit=$details[1];
    $contient=new Contient();
    $exist=$contient->getQuantity(intval($id_panier),intval($id_produit));
    if(intval($quantite)!==0)
    {
        if(empty($exist))
        {
            $quantite=1;
            $contient->addToContient(intval($id_panier),$quantite,intval($id_produit));
            header('location: cart.php');
        } 
        else 
        {
            $contient->addMultipleQuantityToContient(intval($quantite),intval($id_panier),intval($id_produit));
            header('location: cart.php');
        }
    } 
    else
    {
        $contient->deleteContientRow(intval($id_panier), intval($id_produit));
        header('location: cart.php');
    }

}

if(isset($_POST['submitProductDelete']))
{
    $id_panier = $_SESSION['cart']['id_panier'];
    $id_produit = $_POST['submitProductDelete'];
    $contient->deleteContientRow(intval($id_panier), intval($id_produit));
    header('location: cart.php');
}

