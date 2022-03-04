<?php session_start();  ?>
<?php require_once('Model/model.php'); ?>
<?php require_once('Controller/header_controller.php'); ?>
<?php require_once('Controller/article_controller.php'); ?>
<?php require_once('Controller/search_bar_controller.php'); ?>

<!-- <pre> <?php // var_dump($article) ?> </pre> -->

<?php ob_start(); ?>
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
<?php $content=ob_get_clean(); ?>
<?php require_once('header.php');   ?>
<?php require_once('Elements/patron.php'); ?>


    