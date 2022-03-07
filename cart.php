<?php $title = "cart" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Produits.php'); ?>

<?php require_once('Controller/user_controller.php');   // Models : User  &  Cart  ?>
<?php require_once('Controller/cart_controller.php');  // Models :  User  &  Cart  &  Contient  &  Produit  ?>

<?php   ob_start();  ?>
<div class="container m-0 ms-5">
            <div class="d-flex flex-column align-items-center mb-1 rounded-0 align-self-lg-center">
                <div class="display-6 px-4 mt-4 mb-4">
                    <b>Your Cart </b>
                </div>
                <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) ): $tot=0; ?>
                    <table class="table p-2">
                        <tr class="p-1">
                            <!--<div class="col-md-2 mt-3 px-2" >Image</div>-->
                            <th class="col-sm-2 px-2"></th>
                            <th class="col-md-1" >Quantité</th>
                            <th class="col-md-1" >Prix</th>
                            <th class="col-md-2">Nom du produit</th>
                            <th  class="col-md">Mis à jour panier</th>
                        </tr>
                        <?php  for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                        <tr class="p-1">
                            <td><img src="<?= $products_infos[$i]['img_url'] ?>" class="cartPicsInCart"></td>
                            <td><?= $quantity[$i]; $quant[]=$quantity[$i]; ?>&#160;<i class="small">unité(s)</i></td>
                            <td><?= $prod=$products_infos[$i]['unit_price']*$quantity[$i];  $price[]=$products_infos[$i]['unit_price']; ?></td>
                            <td><?= $products_infos[$i]['nom_produit'] ?></td>
                            <td class="col-md-2">
                                <div class="d-flex flex-column">
                                    <form method="POST" class="mt-2 mb-2">
                                        <div class="form-check px-2">
                                            <button type="submit" class="btn btn-dark shadow-sm rounded-2 small" value="<?= $products_infos[$i]['id_produit']; ?>" name="submitProductDelete"><b class="small">delete</b></button>
                                        </div>
                                    </form>
                                    <form method="POST" class="px-2">
                                        <label for="selectQuant">Qty:</label>
                                        <select name="selectQuant" class="h-25 mt-1">
                                            <option value="<?php echo $quantity[$i]; ?>,<?= $products_infos[$i]['id_produit'];?>"> <?= $quantity[$i]; ?> </option>
                                            <?php for($j=0;$j<=intval($products_infos[$i]['units_in_stock']);$j++): ?>
                                                <option value="<?php echo $j; ?>,<?= $products_infos[$i]['id_produit'];?>"> <?= $j; ?> </option>
                                            <?php endfor; ?>
                                        </select>
                                        <button class="form-check btn btn-dark shadow-sm rounded-2 mb-1 small" id="smallBtn" type="submit" name="submitCartUpdate" value="select"><b class="small">ajouter au panier</b></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                       <?php endfor; ?>
                    </table>
                    <div class="h3"><?php for($i=0;$i<=isset($price[$i]);$i++){ $tot+=$price[$i]*$quant[$i]; } echo 'cart total: '.$tot; ?></div>
                    <form method="POST">
                        <div class="mb-3 form-check px-4">
                            <button type="submit" class="btn btn-dark rounded-0 px-5" name="payCart">pay</button>
                        </div>
                    </form>
                <?php else:    //here the else ?>
                <div class="row">
                    <div class="display-5 border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2 text-center">
                        <b>your cart is still empty </b>
                    </div>
                </div>
            </div>
            <?php endif; ?>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('View/patron.php'); ?>
