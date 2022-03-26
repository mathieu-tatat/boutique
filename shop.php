<<<<<<< Updated upstream
<?php
    session_start();
	$conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    class Produits 
    {
        // Méthodes  
        public function __construct() { }
       
        public function get_info_produits(){

            $conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // prepare la recuperation des infos de tout les produits 
        $req = $conn->prepare("SELECT * FROM Produits order by id_produit DESC");
        //execute la requete
        $req->execute();
        
        $produits = $req->fetchAll();

        return $produits;
       
        }

    }
    // creattion de mes produits
    $article = new Produits();
    $items = $article-> get_info_produits(); 
?> 


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="shop.css">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>boutique/shop</title>
  </head>
  <body>
    
<header>
 
</header>

<main>

  
<div class="ban"><img src="Elements/logos/fox.svg">
<img src="Elements/logos/man.svg">
</div>
    <div class= "content">
        <div class="card shadow-sm navCat">
            <h3>Categories</h3></br>
            <h4 class="pad">Stylo</h4>
                <ul class="pad">bille</ul>
                <ul class="pad">feutre</ul>
                <ul class="pad">4 couleurs</ul>
                <ul class="pad">plume</ul>
            <h4 class="pad">Regle</h4>
                <ul class="pad">fer</ul>
                <ul class="pad">plastique</ul>
            <h4 class="pad">Agenda</h4>
                <ul class="pad">professionnel</ul>
                <ul class="pad">etudiant</ul>
                <ul class="pad">enfant</ul>
        </div>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                     <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
                    <?php foreach($items as $item): ?>
                            <div class="shopRow">
                                <div class="card shadow-sm">
                                    <h4 class= "sizeNom"><a class= "sizeNom" href="article.php?id=<?=$item['id_produit']?>"><?= substr($item['nom_produit'],0,33,)."..."?></a></h4>
                                    <img class="image" src="<?=$item['img_url']?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="cart.php"><button type="button" class="btn btn-sm btn-outline-secondary"><img src="Elements/logos/cart.svg" ></img></a>
                                            </div>
                                            <small class="text-muted"><?= $item['unit_price'] ." €"?></small>
                                        </div>                        
                                    </div>
                                </div>     
                            </div>         
                    <?php endforeach;?>
            
                </div>
            </div>    
        </div>
    </div>
</main>

  </body>
</html>
=======
<?php $title = "shop" ?>
<?php session_start();?>
<?php require_once('Model/Article.php'); ?>

<?php /* require_once('Model/CurrentProduct.php'); ?> */?>
<?php require_once('Model/Produit.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Search.php'); ?>
<?php require_once('Model/Categorie.php'); ?>
<?php require_once('Model/SousCategorie.php'); ?>
<?php require_once('Controller/shop_controller.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php

// creation de mes produits
$souscategorie = new SousCategorie();
$detail = new Article();

?>

<?php ob_start() ?>

    <div class= "content">

        <!-- NavBar -->
        <div class="menuCat">

          <nav class="cat__nav">
            <?php
                // Generation d'une variable contenant le tableau avec chacune des sous categories
                $SCat = $souscategorie->getAllSubCat(); ?>
            <div class="cat__nav__close" onclick="closeCatMobile()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h3>Catégories</h3>
            <ul class="cat__nav__menu ulCat" name="tonton">
               <!-- Generation de la navBar -->
            <?php    for($i=0; $i<count($SCat); $i++) : ?>

            <!-- Evaluation de la condition pour fermer les sousmenu de souscategorie -->
            <?php       if ($i != 0 && $SCat[$i]["nom_categorie"] != $SCat[$i-1]["nom_categorie"]) :?>
                 </ul>
            <?php       endif; ?>

            <!-- Evaluation de la condition pour la creation de chacun des niveau de la navBar -->
            <?php       if ( $i == 0 || ($SCat[$i]["nom_categorie"] != $SCat[$i-1]["nom_categorie"])) :?>
                    <li class="cat__nav__menu__link"><a href="shop.php?id_categorie=<?= $SCat[$i]["id_categorie"] ?>" class="alert-link"><?= $SCat[$i]["nom_categorie"] ?></a></li>
                        <ul class="ulCat"  name="<?= $SCat[$i]["nom_categorie"] ?>">
                            <li class="cat__nav__menu__link"><a href="shop.php?id_sous_categorie=<?= $SCat[$i]["id_sous_categorie"] ?>" ><?= $SCat[$i]["nom_sous_categorie"] ?></a></li>
            <?php       else : ?>
                            <li class="cat__nav__menu__link"><a href="shop.php?id_sous_categorie=<?= $SCat[$i]["id_sous_categorie"] ?>" ><?= $SCat[$i]["nom_sous_categorie"] ?></a></li>
            <?php       endif; ?>

            <?php endfor; ?>
        </nav>
        </div>
          <div class="cat__burger" onclick="openCatMobile()">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
              </svg>
          </div>

          <script>
              function openCatMobile() {
                  document.querySelector('.cat__nav').classList.add('open');
                  document.querySelector('.overlay-cat-mobile').classList.add('open');
              }

              function closeCatMobile() {
                  document.querySelector('.cat__nav').classList.remove('open');
                  document.querySelector('.overlay-cat-mobile').classList.remove('open');
              }
          </script>

        <?= $souscontenu ?>

    </div>




<?php  $content=ob_get_clean(); ?>


<?php require ('View/patron.php'); ?>



>>>>>>> Stashed changes
