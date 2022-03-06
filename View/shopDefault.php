<?php ob_start();?>
    <div class="container-fluid  px-5 mt-3">
        <div class="container-fluid">
            <div class="container row row-cols-xl-3">
                <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
                <?php foreach($items as $item):  ?>
                    <div class="shopRow d-flex flex-column px-3 mb-5">
                        <h4 class= "sizeNom mb-2 mt-2"><a class= "sizeNom" href="shop.php?article_id=<?=$item['id_produit']?>"><?= substr($item['nom_produit'],0,50)?></a></h4>
                        <img class="image mb-2 mt-3" src="<?=$item['img_url']?>">
                        <div class="shop-card row">
                            <div class="d-flex flex-row align-items-center justify-content-between mt-2 me-1">
                                <p class="small">Qté:</p>
                                <small class="text-muted mt-2 me-3"><?= $item['unit_price'] ." €"?></small>
                            </div>
                            <form method="POST" class="d-flex flex-row align-items-center mt-2 me-1">
                                <select class="form-select rounded-0 ms-1 px-4 mb-2" style="width:75%;" aria-label=".form-select-sm example" name="quantity" id="quantityBtn">
                                    <?php if(isset($item['units_in_stock'])): ?>
                                    <option value="<?= 1; ?>" ><?= 1; ?></option>
                                    <?php   for($j=0;$j<=intval($item['units_in_stock']);$j++): //if units in stock = to false units in stock equal to 0 ?>
                                        <option value="<?= $j ?>" ><?= $j ?></option>
                                    <?php  endfor; ?>
                                </select>
                                <button type="submit" class="btn btn-dark border-1 border-dark rounded-2 px-1 ms-2 mb-3 text-nowrap" value="<?= $item['id_produit'] ?>" name="addToCart" >
                                    <p class="small" style="font-size:0.83em;"><b>ajouter au panier</b></p>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php   $souscontenu = ob_get_clean(); ?>