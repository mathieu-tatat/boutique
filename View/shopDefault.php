<?php ob_start();?>
    <div class="container-fluid  px-5 mt-3">
        <div class="container-fluid">
            <div class="container row row-cols-xl-3">
                <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
                <?php foreach($items as $item):  ?>
                    <div class="shopRow d-flex flex-column px-3 mb-5">
                        <h4 class= "sizeNom mb-2 mt-2"><a class= "sizeNom" href="article.php?id=<?=$item['id_produit']?>"><?= substr($item['nom_produit'],0,50)?></a></h4>
                        <img class="image mb-2 mt-3" src="<?=$item['img_url']?>">
                        <div class="shop-card">
                            <form method="POST" class="d-flex flex-row align-items-center mt-2">
                                <p class="small mb-3">Qty:</p>
                                <select class="form-select rounded-0 ms-1 px-4 mb-3" aria-label=".form-select-sm example" name="quantity" id="quantityBtn">
                                    <?php if(isset($item['units_in_stock'])): ?>
                                    <?php   for($j=1;$j<=intval($item['units_in_stock']);$j++): //if units in stock = to false units in stock equal to 0 ?>
                                        <option value="<?= $j ?>" ><?= $j ?></option>
                                    <?php   endfor; ?>
                                </select>

                                <button type="submit" class="btn border-1 border-dark rounded-0 px-1 ms-3 mb-3 text-nowrap" value="<?= $item['id_produit'] ?>" name="addToCart" >
                                    <p class="small">add to cart</p>
                                </button>
                            </form>
                            <?php endif; ?>
                            <small class="text-muted mt-2"><?= $item['unit_price'] ." €"?></small>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php   $souscontenu = ob_get_clean(); ?>