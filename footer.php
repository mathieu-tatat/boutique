
<?php $title = "footer" ?>
<?php require_once('model.php'); ?>
<?php require_once('user_controller.php'); ?>
<?php require_once('search_bar_controller.php'); ?>
<?php require_once('shop_controller.php');  ?>
<?php require_once('index_controller.php');  ?>
<?php require_once('footer_controller.php');  ?>
<?php ob_start(); ?>


<nav class="d-flex flex-column align-items-center ">
            <div class= "footStyle">
                <a href="index.php" class="alert-link"><img src="Elements/logos/foxwhite.png"></a>
                <div class="d-flex align-items-center justify-content-around myFooter">
                <a class="linkFoot" href="shop.php" ><div class="text-center footerText">Produits</div></a>
                <a class="linkFoot" href="profil.php" ><div class="text-center footerText">Profil</div></a>
                <a class="linkFoot" href="contact.php" ><div class="text-center footerText">Contact</div></a>
                </div>
            </div>
            <div class="border-top border-secondary line ml"></div>
            <div class="d-flex flex-row justify-content- my-2 logoFoot">
                <div class="linkFoot"><a href="https://github.com/mathieu-tatat/boutique"><img src="Elements/logos/github.png"></a></div>
                <div class="linkFoot"><a href="https://www.linkedin.com"><img src="Elements/logos/linkedin.png"></a></div>
                <div class="linkFoot"><a href="https://www.facebook.com/"><img src="Elements/logos/facebook.png"></a></div>
                <div class="linkFoot"><a href="https://www.instagram.com/"><img src="Elements/logos/insta.png"></a></div>
                <div class="linkFoot"><a href="https://twitter.com/?lang=fr"><img src="Elements/logos/twitter.png"></a></div>
            </div>
            <div class="text-center ms-20 copyright">Trend © 2022 - MGF</div>
        </nav>
<?php $footer = ob_get_clean(); ?>