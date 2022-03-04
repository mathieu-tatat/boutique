<?php $title = "cart" ?>
<?php session_start(); ?>
<?php require_once('Model/model.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/cart_controller.php'); ?>

<?php   ob_start();  ?>
<div class="container px-4 mt-4">
        <div class="d-flex flex-row p-3 mb-5 rounded px-4 mt-4">
            <div class=" row mb-1 rounded-0">
                <div class="display-6 px-4 mt-4 mb-4">
                    <b>Your Cart </b>
                </div>
                <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) ): $tot=0; ?>
                    <?php  for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center mt-1 mb-1">
                                <div class="row-sm " >
                                    <img src="<?= $products_infos[$i]['img_url'] ?>" class="cartPicsInCart">
                                </div>
                                <div class="row-sm" ><?= $quantity[$i]; $quant[]=$quantity[$i]; ?>&#160;<i class="small">unité(s)</i></div>
                                <div class="row-sm" ><?= $prod=$products_infos[$i]['unit_price']*$quantity[$i];  $price[]=$products_infos[$i]['unit_price']; ?></div>
                                <div class="row-sm" ><?= substr($products_infos[$i]['description_produit'],0,22) ?></div>
                                <div class="row-sm" ><?= $products_infos[$i]['nom_produit'] ?></div>
                                <div class="row-sm" >
                                    <form method="POST">
                                        <div class="mb-3 form-check px-4">
                                            <button type="submit" class="btn btn-dark rounded-0" value="<?= $products_infos[$i]['id_produit']; ?>" name="submitProductDelete">delete</button>
                                        </div>
                                    </form>
                                </div>
                                <form method="POST">
                                        <label for="selectQuant">Qty:</label>
                                        <select name="selectQuant" class="h-25">
                                            <option value="<?php echo $quantity[$i]; ?>,<?= $products_infos[$i]['id_produit'];?>"> <?= $quantity[$i]; ?> </option>
                                            <?php for($j=0;$j<=intval($products_infos[$i]['units_in_stock']);$j++): ?>

                                                <option value="<?php echo $j; ?>,<?= $products_infos[$i]['id_produit'];?>"> <?= $j; ?> </option>
                                        <?php endfor; ?>
                                        </select>
                                    <input class="btn btn-dark rounded-0 small" id="smallBtn" type="submit" name="submitCartUpdate" />
                                </form>
                            </div>
                        </div>
                    <?php endfor ?>
                    <div class="h3"><?php for($i=0;$i<=isset($price[$i]);$i++){ $tot+=$price[$i]*$quant[$i]; } echo 'cart total: '.$tot; ?></div>
                    <form method="POST">
                        <div class="mb-3 form-check px-4">
                            <button type="submit" class="btn btn-dark rounded-0 px-5" name="payCart">pay</button>
                        </div>
                    </form>
                <?php else: ?>
                <div class="row">
                    <div class="display-5 border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2 text-center"">
                    <b>your cart is still empty </b>
                </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('Elements/patron.php'); ?>
