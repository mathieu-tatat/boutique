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
    $errors=array();
    $check=0;
    if(empty($_POST['prenom'])){ array_push($errors,'please insert your lastname'); $check++; }
    if(empty($_POST['nom'])){ array_push($errors,'please insert your username'); $check++;  }
    if(empty($_POST['email'])){ array_push($errors,'please insert your email'); $check++;  }
    if(empty($_POST['address'])){ array_push($errors,'please insert your adress'); $check++;  }
    if(empty($_POST['code_postal'])){ array_push($errors,'please insert your postal code'); $check++;  }
    if(empty($_POST['password'])){ array_push($errors,'please insert your password'); $check++;  }

    $tmp= '<div class="border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2 text-center" >';
    foreach($errors as $error => $value){
        if($check>1) {
            $tmp.= 'please fill in all the fields';
            break;
        } else {
            $tmp.=$value;
        }
    }
    if(empty($errors)){
        $test=0;
        $user= new User();
        $test= $user->checkExistsForUpdate($_POST['email']);
        $test=intval($test['count']);
        if($test===0){
            $id_utilisateur=$user_infos['id_utilisateur'];
            $id_droit=$user_infos['id_droit'];
            $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
            $user->userUpdate($_POST['prenom'],$_POST['nom'],$_POST['email'],$password,
                $_POST['address'],intval($_POST['code_postal']),intval($id_droit),intval($id_utilisateur));
            $session=password_hash($_POST['email'],PASSWORD_BCRYPT);
            $_SESSION['connected']=$session;
            header('location:profil.php');
            exit();
        } else {
            $tmp.='this user already exist <br> please choose another email';
        }
    }
    $tmp.='</div>';
}

