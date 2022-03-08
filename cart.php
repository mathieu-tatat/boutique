<?php $title = "Your cart" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Produit.php'); ?>

<?php require_once('Controller/user_controller.php');   // Models : User  &  Cart  ?>
<?php require_once('Controller/cart_controller.php');  // Models :  User  &  Cart  &  Contient  &  Produit  ?>

<?php   ob_start();  ?>
<div class="container d-flex flex-row justify-content-center align-items-center my-3">
    <div class="rounded-0">

        <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) ): $tot=0; ?>

            <table class="table p-2">
                <!-- Table header -->
                <tr class="p-1">
                    <th class="col-sm-2 px-2"></th>
                    <th class="col-md-2" >Quantité</th>
                    <th class="col-md-2" >Prix Total</th>
                    <th class="col-md-2">Nom du produit</th>
                    <th class="col-md-4 text-end">Mis à jour panier</th>
                </tr>

                <?php $infosProduitsDansPanier= [];?>
                <!-- table content -->
                
                <?php  for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                    <?php array_push($infosProduitsDansPanier, array($products_infos[$i]["id_produit"],$quantity[$i])) ?>
                    
                <tr class="p-1">
                    <td><img src="<?= $products_infos[$i]['img_url'] ?>" class="image"></td>
                    <td class="align-middle"><?= $quantity[$i]; $quant[]=$quantity[$i]; ?>&#160;<i class="small">unité(s)</i></td>
                    <td class="align-middle"><?= $prod=$products_infos[$i]['unit_price']*$quantity[$i];  $price[]=$products_infos[$i]['unit_price']; ?></td>
                    <td class="align-middle"><?= $products_infos[$i]['nom_produit'] ?></td>
                    <td class="align-middle">
                        <div class="d-flex flex-row justify-content-end">

                            <!-- delete button -->
                            <form method="POST">
                                <div class="form-check px-2">
                                    <button type="submit" class="btn btn-dark shadow-sm rounded-2 small" 
                                    value="<?= $products_infos[$i]['id_produit']; ?>" name="submitProductDelete">
                                        <b class="small">Enlever</b>
                                    </button>
                                </div>
                            </form>

                            <!-- Quantity changer -->
                            <form method="POST">
                                <label for="selectQuant">Qty:</label>
                                <select name="selectQuant" class="mt-1">
                                    
                                    <?php for($j=0;$j<=intval($products_infos[$i]['units_in_stock']);$j++): ?>
                                        <?php if ($j == $quantity[$i] ) :?>
                                            <option value="<?php echo $j; ?>,<?= $products_infos[$i]['id_produit'];?>" SELECTED> <?= $j; ?> </option>
                                        <?php else :?>
                                        <option value="<?php echo $j; ?>,<?= $products_infos[$i]['id_produit'];?>"> <?= $j; ?> </option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                                <button class="form-check btn btn-dark shadow-sm rounded-2 mb-1 small" 
                                id="smallBtn" type="submit" name="submitCartUpdate" value="select"><b class="small">changer</b></button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
                <?php endfor; ?>
            </table>           

            <?php $_SESSION['infosProduitsDansPanier'] = $infosProduitsDansPanier;?>
            <form method="POST" action="paiement.php" class="d-flex flex-column align-items-end form-check">
                <div class="h3 mt-4">
                    <?php for($i=0;$i<=isset($price[$i]);$i++){ $tot+=$price[$i]*$quant[$i]; $_SESSION['totalCommande'] = $tot;} echo 'cart total: '.$tot; ?>
                </div>
                <div >
                    <button type="submit" class="btn btn-dark rounded-2 shadow-sm px-5" name="payCart"><b>pay</b></button>
                </div>
            </form>

        <?php else: ?>

        <div class="row">
            <div class="display-5 border border-secondary rounded-0 p-5 my-5 text-center">
                <b>your cart is still empty </b>
            </div>
        </div>

        <?php endif; ?>

    </div>
    
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
