<?php $title = "shop" ?>
<?php session_start();?>
<?php require_once('Model/model.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php
    // creation de mes produits
    $article = new Produits();
    $items = $article-> get_info_produits();
    
?>

<?php ob_start() ?>
<main>
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
                                                <a href="cart.php"><button type="button" class="btn btn-sm btn-outline-secondary"><img src="View/logos/cart.svg" ></img></a>
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
<?php  $content=ob_get_clean(); ?>
<?php require ('header.php'); ?>

<?php require ('patron.php'); ?>