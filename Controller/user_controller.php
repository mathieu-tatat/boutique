<?php

include_once ('Model/User.php');
$user = new User();
$_SESSION['errors'] = array();

// Subscribe____________________________________________________________________________________________________________

if(isset($_POST['submit_subscription']))
{

    // receive all input values from the form
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password_1 = htmlspecialchars($_POST['password_1']);
    $password_2 = htmlspecialchars($_POST['password_2']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $zipCode = htmlspecialchars($_POST['code_postal']);

    // form validation
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($prenom)) { array_push($_SESSION['errors'], "Firstname is required"); }
    if (empty($nom)) { array_push($_SESSION['errors'], "Lastname is required"); }
    if (empty($password_1)) { array_push($_SESSION['errors'], "Password is required"); }
    if (empty($email)) { array_push($_SESSION['errors'], "Email is required"); }
    if ($password_1 != $password_2) { array_push($_SESSION['errors'], "The two passwords do not match"); }
    if (empty($address)) { array_push($_SESSION['errors'], "Address is required"); }
    if (empty($zipCode)) { array_push($_SESSION['errors'], "Code postal is required"); }

    //check if user exists
    $chkExists = $user->chkExists($email);
    if ( gettype($chkExists) == "array" ) {array_push($_SESSION['errors'], "User already exists"); }

    // Finally, register user if there are no errors in the form
    if ( count($_SESSION['errors']) == 0) 
    {
        $user->subscribeUser($prenom, $nom, $email, 
                                $password_1, 
                                $address, $zipCode);
        header('location: ./connexion.php');        
    }
}

// Connect______________________________________________________________________________________________________________

if( isset($_POST['submit_connection']))
{

    // receive all input values from the form
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);

    // form validation:
    // by adding (array_push()) corresponding error unto $errors array
    if(empty($_POST['email'])){ array_push($_SESSION['errors'],'please insert your email'); }
    if(empty($_POST['password'])){ array_push($_SESSION['errors'],'please insert your password'); }

    // check the database to make sure 
    // a user does already exist with the same login and password
    $checkExists = $user->chkExists($email);
    $_SESSION['infos'] = $checkExists;
    if ( !$checkExists ) {array_push($_SESSION['errors'], "Wrong login/password combination"); }
    

    if (count($_SESSION['errors']) == 0) 
    {    
        if ( password_verify($password, $checkExists['password']))
        {
        session_start();    
        session_destroy();
        session_start();
        
        $_SESSION['connected'] = true;
        $_SESSION['cart'] = true;
        
        $_SESSION['id'] = $checkExists["id_utilisateur"];
        $_SESSION['prenom'] = $checkExists["prenom"];
        $_SESSION['nom'] = $checkExists["nom"];
        $_SESSION['email'] = $checkExists["email"];    
        $_SESSION['password'] = $checkExists["password"];        
        $_SESSION['address'] = $checkExists["address"];
        $_SESSION['zipCode'] = $checkExists["code_postal"];
        $_SESSION['droits'] = $checkExists["id_droit"];

        header('location:profil.php');
       
        }
        else
        {
        array_push($_SESSION['errors'], "Wrong login/password combination");
        }
        
    }
}

/*-------------------------------
        RIGHTS CHANGE 
--------------------------------*/
if (isset($_POST['chg_right']))
{
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