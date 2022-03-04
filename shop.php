<?php $title = "shop" ?>
<?php require_once('Model/model.php'); ?>
<?php session_start();?>
<?php require_once('Controller/shop_controller.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/search_bar_controller.php'); ?>


<?php ob_start() ?>
    <div class= "content">
        <div class="shadow-sm px-5 mt-3" id="navCat">
            <h3>Categories</h3><br>
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
        <div class="container-fluid  px-5 mt-3">
            <div class="container-fluid">
                <div class="container row row-cols-xl-3">
                     <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
                    <?php foreach($items as $item):  ?>
                            <div class="shopRow px-3 mb-5">
                                <div class="card border-0 px-3">
                                    <h4 class= "sizeNom mb-2 mt-2"><a class= "sizeNom" href="article.php?id=<?=$item['id_produit']?>"><?= substr($item['nom_produit'],0,33,)."..."?></a></h4>
                                    <img class="image mb-2 mt-3" src="<?=$item['img_url']?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <div class="col-md text-justify" >
                                                    <form method="POST">
                                                        <div class="d-flex flex-row mt-3 ms-4">
                                                            <form method="POST">
                                                                 <select class="form-select form-select-sm px-4 ms-4 rounded-0" aria-label=".form-select-sm example" name="quantity" id="quantityBtn">
                                                               <?php if(isset($item['units_in_stock'])): ?>
                                                                   <?php   for($j=1;$j<=intval($item['units_in_stock']);$j++): //if units in stock = to false units in stock equal to 0 ?>
                                                                       <option value="<?= $j ?>" ><?= $j ?></option>
                                                                   <?php   endfor; ?>
                                                                 </select>
                                                                <button type="submit" class="btn btn-sm mt-3 mb-2" value="<?= $item['id_produit'] ?>" name="addToCart" >
                                                                   <img src="Elements/icons/cart.svg" class="cartPicsshop">
                                                               </button>
                                                            </form>
                                                            <?php endif; ?>
                                                        </div>
                                                    </form>
                                                </div>
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
<?php  $content=ob_get_clean(); ?>
<?php require ('header.php'); ?>
<?php require_once('Controller/shop_controller.php'); ?>


<?php require ('patron.php'); ?>