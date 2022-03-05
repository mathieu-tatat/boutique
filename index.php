<?php session_start(); ?>
<?php $title = "Accueil" ?>

<?php require_once('Model/Model.php'); ?>
<?php require_once( 'Model/Article.php') ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/search_bar_controller.php'); ?>
<?php require_once('Controller/shop_controller.php');  ?>
<?php require_once('Controller/article_controller.php');  ?>

<?php ob_start(); ?>
    <style>
        body{


        }
        .img-carousel{
            width: 30%;
            display: block;
            margin: 0 auto;
            aspect-ratio: 1 / 1.5;
            object-fit: contain;
            object-position: bottom;
            border-radius: 6px;
        }
        .carousel-indicators{
            bottom: -55px !important;
        }
        .row{
            padding-bottom:50px;
            margin-bottom:100px;
            width:80%;
            display:flex;
            margin:auto !important;
        }


        .carousel-indicators li {
            border-bottom: 5px solid !important;
            opacity: .5 ;
            transition:opacity .4s ease !important;
            color: black !important;
        }
        .carousel-control-next,
        .carousel-control-prev /*, .carousel-indicators */ {
            filter: invert(100%);
        }
        .banner{
            background-image: url("Elements/Media/banner2.jpg");
            height: 150px;
            margin-bottom:20px;
            color:white;
            display:flex;

            font-size: 3vw;
            font-family: 'Nanum Myeongjo', serif;



        }
        .slogan{
            font-size:10px;


        }
        .trade{
            font-size:40px;
            padding-left:10px;
        }
        .ajouts{
            background-color:#201E1F;
        }
        .start{
            display:flex;
            justify-content:start;
        }
        .end{
            display:flex;
            justify-content:end;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="Elements/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&family=Smooch+Sans:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <body>
    <div class="banner">
        <div class="start"><h2 class="trade">TRADE</h2></div>
        <div class="end"><p class="slogan">Papershop</p> </div>

    </div>
    <?php

    $article=$detail->get_article_details(intval($id_produit));
    $items=$article;

    ?>
    <h2 class="text-center text-light pb-2 ajouts">Derniers ajouts</h2>
    <div class="container-fluid">
        <div class="row justify-content-center mg-tp-20">
            <div class="col-lg-10">
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <?php
                        $i = 0;
                        foreach($items as $item){
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
                        foreach($items as $item){
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
    </body>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require_once('header.php'); ?>
<?php require ('View/patron.php'); ?>