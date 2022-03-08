<?php $title = "profil" ?>
<?php session_start(); ?>

<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Produits.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart  ?>
<?php require_once('Controller/profil_controller.php'); // Models : User  &  Cart  &  Contient  &  Produit ?>
<?php require_once ('Controller/search_bar_controller.php'); // Models : Search ?>



<?php   ob_start();  ?>
        <div class="d-flex flex-column justify-content-between align-items-center">
            <div class="d-flex container-fluid flex-row justify-content-evenly align-items-center mt-3">
                <a href="#settings-path" class="d-flex flex-column align-items-center">
                    <div class="h-1 mt-2"><h1><b>Compte</b></h1></div>
                </a>
                <a href="#order-path" class="d-flex flex-column align-items-center">
                    <div class="h-1 mt-2"><h1><b>Commandes</b></h1></div>
                </a>
            </div>
            <div class="container-fluid">
                <div class="d-flex flex-row mt-3 justify-content-center align-items-center">
                    <form class="p-2 mt-3 border-ligth rounded-2 shadow-sm mb-5 border border-ligth p-3" action=""  method="POST">
                        <div class="px-4 mt-4 mb-1"><h3>Mes Infos Personnelles</h3></div>
                        <small class="text-muted px-5 mb-3">Mis à jour de mes informations</small>
                        <div class="row  align-items-center  px-4 mt-2 mb-3">
                            <div class=" px-2 mt-1 mb-2"><h5>Données de facturation</h5></div>
                            <div class="form-group col">
                                <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['prenom']; ?>" name="prenom">
                            </div>
                            <div class="form-group col">
                                <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['nom']; ?>" name="nom">
                            </div>
                        </div>
                        <div class="row px-4 mt-2 mb-3">
                            <div class="form-group col">
                                <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['address']; ?>" name="address">
                            </div>
                            <div class="form-group col">
                                <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['code_postal']; ?>" name="code_postal">
                            </div>
                        </div>
                        <hr/>
                        <div class="row px-4 mt-3" >
                            <div class=" px-2 mt-1 mb-3"><h5>Contact</h5></div>
                            <div class="form-group row">
                                <input type="text" class="col-form p-1 px-2 rounded-1" style="border:solid 1px darkgray;width:83%;" placeholder="<?= $user_infos['email']; ?>" name="email">
                            </div>
                        </div>
                        <div class="row px-4 mt-2" >
                            <div class="form-group col">
                                <input type="password" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Password" name="password">
                            </div>
                            <div class="form-group col">
                                <input type="password" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Confirmation Password" name="pass_conf">
                            </div>
                        </div>
                        <?php if(isset($tmp)){ echo $tmp;} ?>
                        <div class="d-flex justify-content-start align-items-center px-4" >
                            <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submit_subscription">mis à jour</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between align-items-center">
            <div class="p-2 mt-3 border-ligth rounded-2 shadow-sm mb-5 border border-ligth p-3 w-75" id="order-path">
                <table class="table">
                    <tr class="display-6 px-1 mt-4 mb-4">
                        <th>Your Orders </th>
                    </tr>
                    <?php if(isset($_SESSION['connected']) and isset($orders)): ?>
                        <tr class=" shadow-sm border border-light border-1 p-3 mb-3 rounded-2">
                            <!--<div class="col-md-2 mt-3 px-2" >Image</div>-->
                            <th >Order id</th>
                            <th >Total Price</th>
                            <th >Date</th>
                            <th >Paid with</th>
                            <th >User details</th>
                            <th >Email</th>
                            <th >Details</th>
                        </tr>
                        <?php if(!empty($orders)):  ?>
                            <?php for($i=0;$i<=isset($orders[$i]);$i++): ?>
                                <tr>
                                    <td ><?=  $orders[$i]['id_commande'] ?></td>
                                    <td ><?=  $orders[$i]['price'] ?></td>
                                    <td ><?=  substr($orders[$i]['date_commande'],0,16) ?></td>
                                    <td ><?= $orders[$i]['nom_paiement'] ?></td>
                                    <td ><?=  $val1=$user_infos['nom'].' '.$user_infos['prenom']; ?></td>
                                    <td ><?=  $user_infos['email'] ?></td>
                                    <td >
                                        <form method="POST" action="">
                                            <div class="mb-3 form-check px-4">
                                                <button type="submit" class="btn btn-dark px-1 rounded-2 shadow-sm" name="detailsCommande" value="<?=  $orders[$i]['id_commande'] ?>"><b>details</b></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <th class="row">
                                    you don't have any order yet;
                                </th>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>



<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('View/patron.php'); ?>




