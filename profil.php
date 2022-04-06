<?php $title = "profil" ?>
<?php session_start(); ?>

<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Produit.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart  ?>
<?php require_once('Controller/profil_controller.php'); // Models : User  &  Cart  &  Contient  &  Produit ?>



<?php   ob_start();  ?>

<div class="d-flex flex-column justify-content-center align-items-center my-3">
        
        <!-- Infos profil -->
    <div class="container-fluid">
        <div class="d-flex flex-row justify-content-center align-items-center">
            <form class="border-ligth rounded-2 shadow-sm border p-3" action=""  method="POST">

                <div class="mt-4 mb-1">
                    <h3>Mes Infos Personnelles</h3>
                </div>

                <small class="text-muted mb-3">Mis à jour de mes informations</small>

                <div class="row align-items-center px-4 mt-2 mb-3">

                    <div class="h5 py-1">
                       Données de facturation
                    </div>

                    <div class="form-group col py-1">
                        <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['prenom']; ?>" name="prenom">
                    </div>

                    <div class="form-group col py-1">
                        <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['nom']; ?>" name="nom">
                    </div>

                </div>

                <div class="row align-items-center px-4 mt-2 mb-3">

                    <div class="form-group col py-1">
                        <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['address']; ?>" name="address">
                    </div>
                    <div class="form-group col py-1">
                        <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['code_postal']; ?>" name="code_postal">
                    </div>

                </div>

                <hr/>

                <div class="row align-items-center px-4 mt-2 mb-3">
                    <div class="form-group row py-1">
                        <h5>Contacts</h5>
                    </div>

                    <div class="form-group row py-1">
                        <input type="text" class="col-form p-1 rounded-1 container-fluid" style="border:solid 1px darkgray;" placeholder="<?= $user_infos['email']; ?>" name="email">
                    </div>
                    <div class="form-group row py-1">
                        <input type="password" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Password" name="password">
                    </div>


                        <div class="py-2">
                            <button type="submit" class="btn btn-dark rounded-2 py-2 mb-4 mt-4 p-2 shadow-sm" name="submit_subscription">mis à jour</button>
                        </div>
                </div>

            </form>

        </div>
    </div>

    <!-- Commandes -->
   

    <div class="container-xl px-4 my-4 border border-secondary border-1">

        <table class="table">
            <tr class="display-6 px-1 p-2 mt-4 mb-4 text-nowrap">
                <th>Commandes</th>
            </tr>
            <?php if(isset($_SESSION['connected']) and isset($orders)): ?>
                <tr>
                    <th>Date</th>
                    <th class="p-1">Prix Total</th>
                    <th class="p-1">Payé avec</th>
                    <th class="p-1">Details</th>
                </tr>
                <?php if(!empty($orders)):  ?>
                    <?php for($i=0;$i<=isset($orders[$i]);$i++): ?>
                        <?php $date = substr($orders[$i]['date_commande'],0,10)?>
                        <tr>
                            <td ><?= $date  ?></td>
                            <td class="p-1"><?=  $orders[$i]['price'] ?></td>                                
                            <td class="p-1"><?= $orders[$i]['nom_paiement'] ?></td>
                            <td class="p-1">
                                <form method="POST" action="">
                                    <div class="mb-3 form-check">
                                        <button type="submit" class="btn btn-dark px-1 py-1 rounded-2 shadow-sm" name="detailsCommande" value="<?=  $orders[$i]['id_commande'] ?>"><b>details</b></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endfor; ?>
                <?php else: ?>
                    <tr>
                        <th class="row p-2">
                            you don't have any order yet;
                        </th>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </table>

    </div>

</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>




