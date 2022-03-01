<?php

foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars((string)$value, ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE,
        'UTF-8', /*double_encode*/false );
}

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



if(isset($_POST['submit_subscription'])){
    $errors=array();
    $check=0;
    if(empty($_POST['prenom'])){ array_push($errors,'please insert your lastname'); $check++; }
    if(empty($_POST['nom'])){ array_push($errors,'please insert your username'); $check++;  }
    if(empty($_POST['email'])){ array_push($errors,'please insert your email'); $check++;  }
    if(empty($_POST['address'])){ array_push($errors,'please insert your adress'); $check++;  }
    if(empty($_POST['code_postal'])){ array_push($errors,'please insert your postal code'); $check++;  }
    if(empty($_POST['password'])){ array_push($errors,'please insert your password'); $check++;  }
    if(empty($_POST['pass_conf'])){ array_push($errors,'please confirm your password'); $check++;  }

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
        $test= $user->checkExists($_POST['prenom'],$_POST['email']);
        $test=intval($test['count']);
        if($test===0){
            $id_droit=1;
            $token=password_hash($_POST['email'], PASSWORD_BCRYPT);         // token______________________________
            $password=password_hash($_POST['password'], PASSWORD_BCRYPT);         // token______________________________
            $user->subscribeUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$password,
                $_POST['address'],$_POST['code_postal'],$id_droit,$token);
            header('location:connexion.php');
        } else {
            $tmp.='this user already exist <br> please choose another username';
        }
    }
    $tmp.='</div>';
}


if( isset($_POST['submit_connection'])){

    $errors=array();
    if(empty($_POST['email'])){ array_push($errors,'please insert your email'); }
    if(empty($_POST['password'])){ array_push($errors,'please insert your password'); }

    $tmp= '<div class="border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2" >';

    foreach($errors as $error => $value){
        if(count($errors)>1) {
            $tmp.= 'please fill in all the fields';
            break;
        } else {
            $tmp.=$value;
        }
    }

    if(empty($errors)){
        $user= new User();
        $all_infos= $user->getAllInfos();
        // test occurence of email hash
        $verify=0;
        foreach($all_infos as $utilisateur => $info){
            foreach($info as $column => $value){
                if( (password_verify($_POST['password'],$value)===true) ){
                    $verify++;
                }
            }
        }
        var_dump($verify);
        $test=$user->validateUserConnection($_POST['email'],$_POST['password']);
        var_dump($all_infos);
        //$token=$user->getToken($_POST['email']);
        if($test['count']>0){
            //$token=$token['token'];
            //$user=$user->updateToken($token['token']);
            //$_SESSION['connected']=$token['token'];
            //header('location:profil.php');
        }  else {
            $tmp .= 'wrong email or password';
        }
    }
    $tmp.='</div>';
}

if(isset($_SESSION['connected'])){
    $token=$_SESSION['connected'];
    $user=new User();
    $id=$user->getId($token);
    $cart=$id['email'];
} else {
    $cart='';
}



