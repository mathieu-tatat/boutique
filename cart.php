<?php session_start(); ?>
<?php $title = "Votre Panier" ?>

<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Produit.php'); ?>

<?php require_once('Controller/user_controller.php');   // Models : User  &  Cart  ?>
<?php require_once('Controller/cart_controller.php');  // Models :  User  &  Cart  &  Contient  &  Produit  ?>

<?php   ob_start();  ?>

<div class="d-flex flex-row justify-content-center align-items-center my-3 mb-5">
    <div class="container-xl my-4">

        <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) ): $tot=0; ?>

            <table class="p-2 mb-2" style="border: solid 1px;">
                <!-- Table header -->
                <tr class="p-1" style="border: solid 0.5px;">
                    <th class="col-md-2 text-center"></th>
                    <th class="col-md-2 text-center" >Qté</th>
                    <th class="col-md-2 text-center" >Prix Total</th>
                    <th class="col-md-2 text-center">Nom du produit</th>
                    <th class="col-md-4 text-center">Mise à jour du panier</th>
                </tr>

                <?php $infosProduitsDansPanier= [];?>
                <!-- table content -->
                
                <?php  for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                    <?php array_push($infosProduitsDansPanier, array($products_infos[$i]["id_produit"],$quantity[$i])) ?>
                    
                <tr class="p-1">
                    <td class="px-md-0 ps-1"><img src="<?= $products_infos[$i]['img_url'] ?>" class="image"></td>
                    <td class="align-middle text-center"><?= $quantity[$i]; $quant[]=$quantity[$i]; ?>&#160;<i class="small"></i></td>
                    <td class="align-middle text-center"><?= $prod=$products_infos[$i]['unit_price']*$quantity[$i];  $price[]=$products_infos[$i]['unit_price']; ?> € </td>
                    <td class="align-middle text-center"><?= $products_infos[$i]['nom_produit'] ?></td>
                    <td class="align-middle text-center">
                        <div class="d-flex flex-column">

                            <!-- delete button -->
                            <form method="POST">
                                <div class="form-check px-2">
                                    <button type="submit" class="btn btn-dark shadow-sm rounded-2 small" 
                                    value="<?= $products_infos[$i]['id_produit']; ?>" name="submitProductDelete">
                                        <b class="small">Supprimer</b>
                                    </button>
                                </div>
                            </form>

                            <!-- Quantity changer -->
                            <form method="POST" style="padding-bottom:6px;">
                                <label for="selectQuant">Qté:</label>
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
                                id="smallBtn" type="submit" name="submitCartUpdate" value="select"><b class="small">Modifier</b></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endfor; ?>
            </table>           

            <?php $_SESSION['infosProduitsDansPanier'] = $infosProduitsDansPanier;?>
            
            <form method="POST" action="paiement.php" class="d-flex flex-column align-items-center form-check">
                <div class="h3 mt-4 py-1">
                    <?php for($i=0;$i<=isset($price[$i]);$i++){ $tot+=$price[$i]*$quant[$i]; $_SESSION['totalCommande'] = $tot;} echo 'Total du panier: '.$tot; ?>
                    €
                </div>
                <div >
                    <button type="submit" class="btn btn-dark rounded-2 shadow-sm px-5" name="payCart"><b>Payer</b></button>
                </div>
            </form>

        <?php else: ?>

        <div class="row">
            <div class="display-5 border border-secondary rounded-0 p-5 my-5 text-center">
                <b>Votre panier est vide</b>
            </div>
        </div>

        <?php endif; ?>

    </div>
    
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
