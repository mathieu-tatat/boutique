<?php

require_once('Model/Cart.php');
require_once('Model/Contient.php');
require_once('Model/Produit.php');
$user= new User();

if(isset($_SESSION['connected']))
{    
    $all_infos= $user->getAllInfos();

    // test occurence of password hash
    $verify=0;
    foreach($all_infos as $utilisateur => $info)
    {
        foreach($info as $column => $value){
            if( (password_verify($value,$_SESSION['connected'])) ){
                $email=$value;
                $verify_profile=1;
                break;
            }
        }
    }

    //if user and session exist
    if($verify_profile=1)
    {  
        // INFOS________________________________________________________________________________________________________
        $user_infos = $user->getUserInfos($_SESSION["id"]); // get all my infos for placeholders

        // CART_________________________________________________________________________________________________________
        $cart = new Cart();

        // get my panier id
        $id_cart = $cart->getCart($_SESSION["id"]);

        // instantiate a object content for cart with the panier id
        if(isset($id_cart['id_panier']) )
        {
            $contient = new Contient($id_cart['id_panier']);
            // get the panier content
            $full_cart = $contient->getContient($id_cart['id_panier']);    
            $products = new Produits();

            foreach($full_cart as $key => $content)
            {
            $products_infos[]=$products->getProduitsFromId($content['id_produit']);
            $quantity[]=$content['quantite'];
            }
        } 

        // ORDERS_______________________________________________________________________________________________________
        
        $orders=$user->getAllOrders($_SESSION["id"]);
    } 
    else 
    {
        header('location:connexion.php');  // if the hash doesn't match
        exit();
    }
} 
else 
{
    header('location:connexion.php');   // if the session doesn't exists
    exit();
}



// Update_______________________________________________________________________________________________________________

if(isset($_POST['submitUserUpdate'])){

    // receive all input values from the form
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password_1 = htmlspecialchars($_POST['password_1']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $zipCode = htmlspecialchars($_POST['code_postal']);

    // form validation
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($prenom)) { array_push($_SESSION['errors'], "Firstname is required"); }
    if (empty($nom)) { array_push($_SESSION['errors'], "Lastname is required"); }
    if (empty($password_1)) { array_push($_SESSION['errors'], "Password is required"); }
    if (empty($email)) { array_push($_SESSION['errors'], "Email is required"); }
    if (!preg_match('/^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/', $email)) { array_push($_SESSION['errors'], "Email format is wrong"); }
    if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password_1)) { array_push($_SESSION['errors'], "Password format is wrong");}
    if (empty($address)) { array_push($_SESSION['errors'], "Address is required"); }
    if (empty($zipCode)) { array_push($_SESSION['errors'], "Code postal is required"); }
    if (!preg_match('/^[0-9]{5}$/', $zipCode)) { array_push($_SESSION['errors'], "ZipCode format is wrong");}

    // check the user id for the update
    $chkId = $user -> getId($email);

    // if is not the same of the session means the user wants to change its email
    if($_SESSION['id'] != $chkId['id_utilisateur'] ){

        // check if this email already exists
        $chkExists = $user -> chkExists($email);
        // throw an error if it exists
        if(!empty($chkExists)){
            array_push($_SESSION['errors'], "User already exists");
        }
    }

    if($_SESSION['errors']==0){

        $password = password_hash($password_1, PASSWORD_BCRYPT);
        $id = $_SESSION['id'];

        $user -> userUpdate($prenom, $nom, $email, $password,
            $address, $zipCode, $id);

        $_SESSION['id'] = $id;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['address'] = $address;
        $_SESSION['zipCode'] = $zipCode;

        header('location:profil.php');
        exit();

        }
}


// details commande______________________________________________________________________________________________________

if(isset($_POST['detailsCommande'])){

    $_SESSION['commande_details']=$_POST['detailsCommande'];
    header('location:commande.php');
    exit();
}