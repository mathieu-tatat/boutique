<?php

foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars((string)$value, ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE,
        'UTF-8', /*double_encode*/false );
}

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Subscribe____________________________________________________________________________________________________________

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

    $tmp= '<div class="border border-secondary rounded-0 px-4 mb-4 mt-2 ml-2 text-center" >';
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
            $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
            var_dump($test);
            $user->subscribeUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$password,
                $_POST['address'],intval($_POST['code_postal']),intval($id_droit));
            $id_utilisateur=$user->getId($_POST['email']);
            $user->insertCart(intval($id_utilisateur['id_utilisateur']));
            header('location:connexion.php');
            exit();
        } else {
            $tmp.='this user already exists please choose another username';
        }
    }
    $tmp.='</div>';
}

// Connect______________________________________________________________________________________________________________

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
        $myhash= $user->getHash($_POST['email']);
        if(!empty($myhash)) {
            if( (password_verify($_POST['password'],$myhash['password'])) ){
                $test=$user->validateUserConnection($_POST['email'],$myhash['password']);
                $_SESSION['connected']=$_POST['email'];
                $_SESSION['cart']=new Cart();
                header('location:profil.php');
                exit();
            } else {
                $tmp .= 'wrong email or password';
            }
        } else {
            $tmp .= 'wrong email or password';
        }
    }
    $tmp.='</div>';
}


