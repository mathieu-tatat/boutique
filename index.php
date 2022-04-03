<?php $title = "Accueil" ?>
<?php session_start(); ?>
<?php require_once('Model/Carousel.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/shop_controller.php');  ?>

<?php ob_start(); ?>   
<div class="d-flex flex-column justify-content-center align-items-center my-3">
    <h2 class="text-center">Derniers ajouts</h2>
    <div class="container-fluid">
        <div class="row justify-content-center mg-tp-20">
            <div class="col-lg-10 d-flex flex-row justify-content-center">
                <div id="carousel" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators d-flex flex-row justify-content-center">
                        <?php
                            $carousel = new Carousel();
                            $carouselItems = $carousel->getAllProductsInCarousel();
                            $i = 0;
                            foreach($carouselItems as $item)
                            {
                                $actives = '';
                                if($i == 0){
                                    $actives = 'active';
                            }?>
                            <li data-target="#carousel" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
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
                                <a href='shop.php?article_id=<?= $item["id_produit"]?>' class="carousel-item <?=$actives; ?>">
                                        <img class="img-carousel" src="<?= $item['img_url'] ?>"  width="30%" height="400">
                                </a>
                                <?php $i++; 
                            } ?>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>    

<?php $content = ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
