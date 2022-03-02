<?php

if(isset($_POST['disconnect'])) {
    session_destroy();
    header('location:connexion.php');
}

if(isset($_POST['cart'])){
    header('location:cart.php');
}
