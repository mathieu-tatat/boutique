<?php
    session_start();
	$conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    class Categorie
    {
        // Méthodes  
        public function __construct() { }
       
        public function get_categorie(){

            $conn=new pdo("mysql:host=localhost;dbname=boutique;charset=utf8", "root", "root");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // prepare la recuperation toutes les infos des produits
        $req = $conn->prepare("SELECT * FROM Categories Where id_categorie = ");
        //execute la requete
        $req->execute();
        
        $categorie = $req->fetchAll();

        return $categorie;
       
        }

    }
    $choix = new Categorie();
    $besoin = $choix-> get_categorie(); 
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

  

    <div class= "content">
        <div class="card shadow-sm navCat">
            <h3>Categories</h3></br>
            <h4 class="pad"> Stylo</h4>
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
      
</main>

  </body>
</html>
