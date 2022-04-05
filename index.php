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

    <p class="m-3 p-3 text-justify">Lorem ipsum dolor sit amet. 
        Non aliquam magni ut molestias voluptatem ad quis magni est quibusdam deserunt non velit velit. 
        Est voluptatem nulla  earum assumenda ab odio fugiat qui vero nihil aut incidunt 
        labore qui aliquid sapiente cum dicta optio. At unde galisum in accusamus 
        omnis et corporis galisum qui autem tempora? Ad enim dolores et internos 
        nihil ut enim praesentium qui nisi distinctio. </p>
    <p class="m-3 p-3 text-justify">Hic atque distinctio non error ducimus id earum voluptatibus et 
        iusto numquam id omnis quam est fuga praesentium! Qui modi illo qui esse fuga sit veniam illo. </p>
    <p class="m-3 p-3 text-justify">Hic quis iusto quo voluptatem dolorum qui animi molestias 
        sit quasi dolor id omnis provident 33 reiciendis neque cum exercitationem necessitatibus. 
        Sit dolores laudantium qui galisum perferendis aut libero tempore ut laudantium provident. 
        Qui doloribus fugit sit harum dolorem aut harum internos sed voluptatibus tenetur 33 
        incidunt obcaecati ab quia cupiditate. Est sunt ipsa quo placeat aliquam eos veniam 
        alias sed officia accusamus eum iste repudiandae et saepe optio sed laboriosam dolor. </p>
        <p class="m-3 p-3 text-justify">Lorem ipsum dolor sit amet. 
        Non aliquam magni ut molestias voluptatem ad quis magni est quibusdam deserunt non velit velit. 
        Est voluptatem nulla  earum assumenda ab odio fugiat qui vero nihil aut incidunt 
        labore qui aliquid sapiente cum dicta optio. At unde galisum in accusamus 
        omnis et corporis galisum qui autem tempora? Ad enim dolores et internos 
        nihil ut enim praesentium qui nisi distinctio. </p>
    <p class="m-3 p-3 text-justify">Hic atque distinctio non error ducimus id earum voluptatibus et 
        iusto numquam id omnis quam est fuga praesentium! Qui modi illo qui esse fuga sit veniam illo. </p>
    <p class="m-3 p-3 text-justify">Hic quis iusto quo voluptatem dolorum qui animi molestias 
        sit quasi dolor id omnis provident 33 reiciendis neque cum exercitationem necessitatibus. 
        Sit dolores laudantium qui galisum perferendis aut libero tempore ut laudantium provident. 
        Qui doloribus fugit sit harum dolorem aut harum internos sed voluptatibus tenetur 33 
        incidunt obcaecati ab quia cupiditate. Est sunt ipsa quo placeat aliquam eos veniam 
        alias sed officia accusamus eum iste repudiandae et saepe optio sed laboriosam dolor. </p>
        <p class="m-3 p-3 text-justify">Lorem ipsum dolor sit amet. 
        Non aliquam magni ut molestias voluptatem ad quis magni est quibusdam deserunt non velit velit. 
        Est voluptatem nulla  earum assumenda ab odio fugiat qui vero nihil aut incidunt 
        labore qui aliquid sapiente cum dicta optio. At unde galisum in accusamus 
        omnis et corporis galisum qui autem tempora? Ad enim dolores et internos 
        nihil ut enim praesentium qui nisi distinctio. </p>
    <p class="m-3 p-3 text-justify">Hic atque distinctio non error ducimus id earum voluptatibus et 
        iusto numquam id omnis quam est fuga praesentium! Qui modi illo qui esse fuga sit veniam illo. </p>
    <p class="m-3 p-3 text-justify">Hic quis iusto quo voluptatem dolorum qui animi molestias 
        sit quasi dolor id omnis provident 33 reiciendis neque cum exercitationem necessitatibus. 
        Sit dolores laudantium qui galisum perferendis aut libero tempore ut laudantium provident. 
        Qui doloribus fugit sit harum dolorem aut harum internos sed voluptatibus tenetur 33 
        incidunt obcaecati ab quia cupiditate. Est sunt ipsa quo placeat aliquam eos veniam 
        alias sed officia accusamus eum iste repudiandae et saepe optio sed laboriosam dolor. </p>

</div>    

<?php $content = ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
