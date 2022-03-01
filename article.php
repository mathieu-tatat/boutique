<?php
    session_start();
	$conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    class Article{
      // Méthodes  

        public function __construct() { }
        
        public function get_article_details(){

                $conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                    }else{
                        $id = NULL;
                    }
                //prepare la recuperation toutes les infos du produit recuperés en get 
                $req = $conn->prepare("SELECT * from Produits  WHERE id_produit = ?");
                //execute la requete
                $req->execute(array($id));

                $produit = $req->fetchAll();

                return $produit;
        }
    }

    $detail = new Article();
    $article = $detail->get_article_details();
    
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
<!-- <pre> <?= var_dump($article) ?> </pre> -->

  
    <div class="ban"><img src="Elements/logos/fox.svg">
    <img src="Elements/logos/man.svg">
    </div>
        <div class= "content">
            <div class="card shadow-sm navCat">

            <!-- nav barre categorie  -->
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
                <div class="infosProduit">
            
                <!-- genere le detail des produits en fonction de leurs id   -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            
                                <img class="details" src="<?= $article[0]['img_url']?>">
                                <h4 class= "nomArticle"><?= $article[0]['nom_produit']?></h4>
                            <div class="info">       
                                <small class="units"><?= $article[0]['units_in_stock']." en stock"?></small>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><img src="Elements/logos/cart.svg"></button>
                                <small class="units"><?= $article[0]['unit_price'] ." €"?></small>   
                            </div>
                        </div>                 
                    </div></br>
               <p class="descArticle"><?= $article[0]['description_produit'] ?></p> 
                </div>        
        </div>
    