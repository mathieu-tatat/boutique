<?php ob_start(); ?>
<div class="container">                
    <div class="row">  
        <div  class="col-md-3">
            <img class="image" src="<?= $produit->getImgById($_GET['article_id'])?>">
        </div>
            
        <div class="d-flex flex-column col-md-9 my-5">
        <h4><?= $produit->getNomById($_GET['article_id'])?></h4>
            <div>       
                <small><?= $produit->getUnitsInStockById($_GET['article_id'])." en stock"?></small>
                <small><?= $produit->getUnitPriceById($_GET['article_id'])." €"?></small>   
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <img src="View/logos/cart.svg">
                </button>
            </div>
            
            <p class="p-5 my-2"><?= $produit->getDescriptionById($_GET['article_id']) ?></p>
        </div>
    </div>              
</div>
<?php   $souscontenu = ob_get_clean(); ?>