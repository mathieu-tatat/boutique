<?php $title = "Accueil" ?>
<?php session_start(); ?>
<?php require_once('Model/Carousel.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/shop_controller.php');  ?>

<?php ob_start(); ?>   
<h2 class="text-center">Derniers ajouts</h2>
<div class="container-fluid">
    <div class="row justify-content-center mg-tp-20">
        <div class="col-lg-10">
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <?php
                        $carousel = new Carousel();
                        $carouselItems = $carousel->getAllProductsInCarousel(); 
                        $i = 0;
                        foreach($carouselItems as $item){
                            $actives = '';
                            if($i == 0){
                                $actives = 'active';
                            }
                            ?>
                        <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                        <?php $i++; } ?>
                
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <?php  
                        $i = 0;
                        foreach($carouselItems as $item){
                            $actives = '';
                            if($i == 0){
                                $actives = 'active';
                            }
                            ?>
                            <div class="carousel-item <?=$actives; ?>">
                                <img class="img-carousel" src="<?= $item['img_url'] ?>"  width="30%" height="400">
                            </div>
                            <?php $i++; 
                        } ?>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>