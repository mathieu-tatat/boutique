<?php

$produit=new Produits;
$item=$produit->getProduitsFromId(intval($_GET['article_id']));

?>

<?php ob_start(); ?>
<div class="container">                
    <div class="row align-items-center justify-content-center">
        <div  class="col">
            <img class="image p-5" src="<?= $produit->getImgById($_GET['article_id'])?>">
        </div>
            
        <div class="d-flex flex-column align-items-center justify-content-center col my-5">
        <h4><?= $produit->getNomById($_GET['article_id'])?></h4>
            <div>       
                <small><?= $produit->getUnitsInStockById($_GET['article_id'])." en stock"?></small>
                <small><?= $produit->getUnitPriceById($_GET['article_id'])." €"?></small>   
            </div>
            <div>
                <!-- Stock -->
                <?php if( isset($item['units_in_stock']) && $item['units_in_stock'] == 0) : ?>
                            <p class="text-center"><em>Plus en stock</em></p>
                <?php elseif(isset($item['units_in_stock'])): ?>
                <form method="POST" class="d-flex flex-row align-items-center mt-2 me-1">
                    <p class="small mb-3">Qty:</p>
                    <select class="form-select rounded-0 ms-1 px-4 mb-3" style="width:40%!important;" aria-label=".form-select-sm example" name="quantity" id="quantityBtn">
                        
                        <option value="<?= 1; ?>" ><?= 1; ?></option>
                        <?php   for($j=0;$j<=intval($item['units_in_stock']);$j++): //if units in stock = to false units in stock equal to 0 ?>
                            <option value="<?= $j ?>" ><?= $j ?></option>
                        <?php  endfor; ?>
                    </select>
                    <input type="hidden" value="<?= $item['id_produit'] ?>" name="idProduit">
                    <button type="submit" class="btn btn-dark shadow-sm border-1 border-dark rounded-2 px-1 ms-2 mb-3 text-nowrap"  name="addToCart" >
                        <p class="small" style="font-size:0.75em;"><b>ajouter au panier</b></p>
                    </button>
                </form>
                <?php endif; ?>
            </div>
            
            <p class="p-5 my-2 "><?= $produit->getDescriptionById($_GET['article_id']) ?></p>
        </div>
    </div>              
</div>

<?php   $souscontenu = ob_get_clean(); ?>
