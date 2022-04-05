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
        <div class="container-xl px-4 my-4 border border-secondary border-1">

            <div class="display-6 px-4 mt-4"><b>Settings </b></div>

            <form class="px-4 mt-4" id="updateUserForm" method="POST">

                <div class=" px-2">
                    <label for="exampleInputEmail1" class="form-label"><span class="h6">Email address</span></label>
                    <input type="email" class="form-control rounded-0" name="email" id="exampleInputEmail1" 
                    aria-describedby="emailHelp" value="<?= $_SESSION["email"]?>">
                    <div id="emailHelp" class="form-text">Nous ne partagerons jamais vos données personnelles.</div>
                </div>

                <div class=" px-2">
                    <label for="exampleInputText1" class="form-label"><span class="h6">Prenom</span></label>
                    <input type="text" class="form-control rounded-0" name="prenom" id="exampleInputText1" 
                    aria-describedby="textHelp" value="<?= $_SESSION["prenom"]?>">
                </div>

                <div class=" px-2">
                    <label for="exampleInputText1" class="form-label"><span class="h6">Nom</span></label>
                    <input type="text" class="form-control rounded-0" name="nom" id="exampleInputText1" 
                    aria-describedby="textHelp" value="<?= $_SESSION["nom"]?>">
                </div>

                <div class=" px-2">
                    <label for="exampleInputText1" class="form-label"><span class="h6">Address</span></label>
                    <input type="text" class="form-control rounded-0" name="address" id="exampleInputText1" 
                    aria-describedby="textHelp" value="<?= $_SESSION["address"]?>">
                </div>

                <div class=" px-2">
                    <label for="exampleInputText1" class="form-label"><span class="h6">Code Postal</span></label>
                    <input type="text" class="form-control rounded-0" name="code_postal" id="exampleInputText1" 
                    aria-describedby="textHelp" value="<?= $_SESSION["zipCode"]?>">
                </div>

                <div class="mb-5 px-2">
                    <label for="exampleInputPassword1" class="form-label"><span class="h6">Password</span></label>
                    <input type="password" class="form-control rounded-0" name="password" id="exampleInputPassword1">
                </div>

                <div id="emailHelp" class="form-text small px-4 mb-2">Modifier vos informations personnelles</div>

                <div>
                    <div class="actionProfil py-2">
                        <button type="submit" class="btn btn-dark px-3 py-1 rounded-2 shadow-sm" name="submitUserUpdate"style="margin-bottom: 5px;">soumettre</button>

                        <button type="submit" class="btn btn-dark px-3 py-1 rounded-2 shadow-sm" name="deleteUser"style="margin-bottom: 5px;">supprimer votre compte</button>
                    </div>
                </div>

            </form>

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




