<?php $title = "shop" ?>
<?php session_start();?>
<?php require_once('Model/Article.php'); ?>

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

            <ul class="cat__nav__menu ulCat ms-2 pt-2">
               <!-- Generation de la navBar -->
            <?php    for($i=0; $i<count($SCat); $i++) : ?>

            <!-- Evaluation de la condition pour fermer les sousmenu de souscategorie -->
            <?php       if ($i != 0 && $SCat[$i]["nom_categorie"] != $SCat[$i-1]["nom_categorie"]) :?>

            </ul>

            <?php       endif; ?>

            <!-- Evaluation de la condition pour la creation de chacun des niveau de la navBar -->
            <?php       if ( $i == 0 || ($SCat[$i]["nom_categorie"] != $SCat[$i-1]["nom_categorie"])) :?>
                <li class="cat__nav__menu__link"><a href="shop.php?id_categorie=<?= $SCat[$i]["id_categorie"] ?>" class="alert-link"><?= $SCat[$i]["nom_categorie"] ?></a></li>
                    <ul class="ulCat ms-2"  name="<?= $SCat[$i]["nom_categorie"] ?>">
                        <li class="cat__nav__menu__link ms-3"><a href="shop.php?id_sous_categorie=<?= $SCat[$i]["id_sous_categorie"] ?>" ><?= $SCat[$i]["nom_sous_categorie"] ?></a></li>
            <?php       else : ?>
                        <li class="cat__nav__menu__link ms-3"><a href="shop.php?id_sous_categorie=<?= $SCat[$i]["id_sous_categorie"] ?>" ><?= $SCat[$i]["nom_sous_categorie"] ?></a></li>
            <?php       endif; ?>

            <?php endfor; ?>
            </ul>
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



