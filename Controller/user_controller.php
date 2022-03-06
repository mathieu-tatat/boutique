<?php

// Models : User  &  Cart   ____________________________________________________________________________________________
require_once('Model/User.php');
require_once('Model/Cart.php');

// sec functions _______________________________________________________________________________________________________

 // foreach $_POST of any key --->>> pass it through htmlspecialchars

foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars((string)$value, ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE,
        'UTF-8', /*double_encode*/false );
}

 // filter every $_POST of user input with this controller

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Subscribe____________________________________________________________________________________________________________

if(isset($_POST['submit_subscription'])){

    $errors=array();
    $check=0;

    // check for errors in user inputs and push it in array to display later
    if(empty($_POST['prenom'])){ array_push($errors,'please insert your lastname'); $check++; }
    if(empty($_POST['nom'])){ array_push($errors,'please insert your username'); $check++;  }
    if(empty($_POST['email'])){ array_push($errors,'please insert your email'); $check++;  }
    if(empty($_POST['address'])){ array_push($errors,'please insert your adress'); $check++;  }
    if(empty($_POST['code_postal'])){ array_push($errors,'please insert your postal code'); $check++;  }
    if(empty($_POST['password'])){ array_push($errors,'please insert your password'); $check++;  }
    if(empty($_POST['pass_conf'])){ array_push($errors,'please confirm your password'); $check++;  }

    // div for alert
    $tmp= '<div class="border border-secondary rounded-0 px-4 mb-4 mt-2 ml-2 text-center" >';

    //check for errors
    foreach($errors as $error => $value){
        if($check>1) {
            $tmp.= 'please fill in all the fields';
            break;
        } else {
            $tmp.=$value;
        }
    }

    //if there aren't errors
    if(empty($errors)){
        //test counter
        $test=0;
        // instatiate new user
        $user= new User();
        // check existance in Db
        $test= $user->checkExists($_POST['prenom'],$_POST['email']);
        $test=intval($test['count']);

        // if no errors occur so that test equal to zero
        if($test===0){

            //assign default right__________
            $id_droit=1;
            // hash the pass
            $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
            // then subscribe
            $user->subscribeUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$password,
                $_POST['address'],intval($_POST['code_postal']),intval($id_droit));
            // now get id
            $id_utilisateur=$user->getId($_POST['email']);
            // instatiate a new cart
            $cart=new Cart();
            // create a new cart in Db
            $cart->insertCart(intval($id_utilisateur['id_utilisateur']));
            // redirect to connection
            header('location:connexion.php');
            exit();
        } else {
            $tmp.='cet utilisateur existe déjà, <br>choisissez un autre email et nom utilisateur svp';
        }
    }
    $tmp.='</div>';
}

// Connect______________________________________________________________________________________________________________

if( isset($_POST['submit_connection'])){

    $errors=array();

    // check for errors in user inputs and push it in array to display later
    if(empty($_POST['email'])){ array_push($errors,'please insert your email'); }
    if(empty($_POST['password'])){ array_push($errors,'please insert your password'); }

    // div for alert
    $tmp= '<div class="border border-secondary rounded-2 px-4 mb-2 mt-2 ml-2" >';

    //check for errors

    foreach($errors as $error => $value){
        if(count($errors)>1) {
            $tmp.= 'remplir tous les champs svp';
            break;
        } else {
            $tmp.=$value;
        }
    }

    //if there aren't errors
    if(empty($errors)){

        //instantiate new user
        $user= new User();
        //get hash to test
        $myhash= $user->getHash($_POST['email']);
        // if there is a hash in a row
        if(!empty($myhash)) {
            // test the hash if valid
            if( (password_verify($_POST['password'],$myhash['password'])) ){
                // validate connection
                $test=$user->validateUserConnection($_POST['email'],$myhash['password']);
                // get id
                $myid=$user->getId($_POST['email']);
                // get cart id
                $mycartid=$user->getCartId($myid['id_utilisateur']);

                // assign sessions

                $_SESSION['connected']=$_POST['email'];
                $_SESSION['cart']=$mycartid['id_panier'];
                // get all user infos
                $_SESSION['infos']=$user->getAllUserInfos($_POST['email']);
                // assign them
                $_SESSION['id'] = $_SESSION['infos']["id_utilisateur"];
                $_SESSION['prenom'] = $_SESSION['infos']["prenom"];
                $_SESSION['nom'] = $_SESSION['infos']["nom"];
                $_SESSION['email'] = $_SESSION['infos']["email"];
                $_SESSION['password'] = $_SESSION['infos']["password"];
                $_SESSION['address'] = $_SESSION['infos']["address"];
                $_SESSION['zipCode'] = $_SESSION['infos']["code_postal"];
                $_SESSION['droits'] = $_SESSION['infos']["id_droit"];

                // redirect to profil
                header('location:profil.php');
                exit();

            } else {
                $tmp .= 'email ou password erroné';
            }
        } else {
            $tmp .= 'email ou password erroné';
        }
    }
    $tmp.='</div>';
}


/*-------------------------------
        RIGHTS CHANGE
--------------------------------*/
if (isset($_POST['chg_right']))
{   $user=new User;
    $user->updateDroit($_POST["id_utilisateur"], $_POST["id_droit"]);
    $_POST["gestion_user"] = "";
}


/*-------------------------------
        DISCONNECT CHANGE
--------------------------------*/
if (isset($_POST['deconnexion']))
{
    session_start();

    session_destroy();
    header('Location: ./connexion.php');
    exit;
}

