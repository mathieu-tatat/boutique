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
