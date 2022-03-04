<?php ob_start();?>
<div class="album py-5 bg-light">
    <div class="container">

        <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
        <?php for($i = 0; $i<count($items); $i++) : ?>
            <?php if($i == 0 || ($i) % 4 == 0) :?>
                <div class="row">
            <?php endif; ?>

            <div class="card shadow-sm col-3 m-2">
                <h4><a class="sizeNom" href="shop.php?article_id=<?=$items[$i]['id_produit']?>"><?= substr($items[$i]['nom_produit'],0,33,)."..."?></a></h4>
                <a href="shop.php?article_id=<?=$items[$i]['id_produit']?>" > <img class="image" src="<?=$items[$i]['img_url']?>"> </a>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="cart.php"><button type="button" class="btn btn-sm btn-outline-secondary"><img src="View/logos/cart.svg" ></img></a>
                        </div>
                        <small class="text-muted"><?= $items[$i]['unit_price'] ." €"?></small>
                    </div>                        
                </div>
            </div>

            <?php if(($i+1) % 4 == 0  || !isset($items[$i+1])) : ?>
                </div>
            <?php endif; ?>

        <?php endfor;?>

    </div>
</div>
<?php   $souscontenu = ob_get_clean(); ?>