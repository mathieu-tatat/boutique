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
                                    <img class="img-carousel" src="<?= $item['img_url'] ?>" >
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
    <h1 class="center-text m-5"> Bienvenue chez Trade</h1>
    <p class="center-text m-3">Magasin généralite en matière de papèterie, et plus si affinité.</p>

</div>

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
