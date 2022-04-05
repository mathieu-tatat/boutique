<?php ob_start();?>
<div class="container-fluid mt-3">

    <div class="container-fluid">

        <div class="container row row-cols-xl-3">

            <!-- pour chaques produits je recupère les infos en fonction de leurs id  -->
            <?php foreach($items as $item):  ?>
                <div class="shopRow d-flex flex-column px-3 mb-5">

                    <!-- nom -->
                    <h4 class= "sizeNom mb-2 mt-2">
                        <a class= "sizeNom" href="shop.php?article_id=<?=$item['id_produit']?>">
                            <?= substr($item['nom_produit'],0,50)?>
                        </a>
                    </h4>

                    <!-- img -->
                    <a href='shop.php?article_id=<?= $item["id_produit"]?>' >
                        <img class="image mb-2 mt-3" src="<?=$item['img_url']?>">
                    </a>

                    <!-- ajout au panier -->
                    <div class="shop-card">
                        <small><?= $item['unit_price'] ."€"?></small>

                        <!-- Stock -->
                        <?php if( isset($item['units_in_stock']) && $item['units_in_stock'] == 0) : ?>

                            <p class="text-center"><em>Plus en stock</em></p>

                        <?php elseif(isset($item['units_in_stock'])): ?>

                            <form method="POST" class="d-flex flex-row align-items-center">

                                <!-- Id produit -->
                                <input type="hidden" name="idProduit" value="<?= $item['id_produit'] ?>">

                                <!-- select Quantity -->
                                <label for="quantity" class="mx-1">Qté:</label>
                                <select class="form-select rounded-0"
                                aria-label=".form-select-sm example" name="quantity" id="quantity" style="width:80px">
                                    
                                        <?php   for($j=0;$j<=intval($item['units_in_stock']);$j++): //if units in stock = to false units in stock equal to 0 ?>
                                            <?php if($j == 1) :?>
                                                <option value="<?= $j ?>" SELECTED><?= $j ?></option>
                                            <?php else : ?>
                                                <option value="<?= $j ?>" ><?= $j ?></option>
                                            <?php endif; ?>
                                        <?php  endfor; ?>
                                    
                                </select>

                                
                                
                                <!-- submit -->
                                <button type="submit" class="btn btn-dark btn-sm rounded-2 mx-2" name="addToCart" >
                                    <img src="View/icons/whiteCart.png" alt="" class="w-25">
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
