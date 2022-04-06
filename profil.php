<?php $title = "Profil" ?>
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
        <div class="d-flex flex-row justify-content-center ">
            <form action="" method="POST">
                <div class="px-2 p-3 mt-1 mb-2">
                    <h5>Données de facturation</h5>
                </div>

                <div class="py-1">
                    <label for="prenom" class="h6 py-1 text-muted px-2 fw-light "><i>Insérer votre prénom</i></label><br>
                    <input type="text" class="p-1 rounded-1 w-100" placeholder="Prénom" name="prenom" value="<?php echo $_SESSION['prenom'] ?>">
                </div>

                <div class="py-1">
                    <label for="nom" class="h6 py-1 text-muted px-2 fw-light "><i>Insérer votre nom</i></label><br>
                    <input type="text" class="p-1 rounded-1 w-100"  placeholder="Nom" name="nom" value="<?php echo $_SESSION['nom'] ?>">
                </div>

                <div class="py-1">
                    <label for="address" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre adresse</i></label><br>
                    <input type="text" class="p-1 rounded-1 w-100"  placeholder="Adresse" name="address" value="<?php echo $_SESSION['address'] ?>">
                </div>

                <div class="py-1">
                    <label for="code_postal" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre code postal</i></label><br>
                    <input type="text" class=" p-1 rounded-1 w-100"  placeholder="Code Postal" name="code_postal" value="<?php echo $_SESSION['zipCode'] ?>">
                </div>

                <div class="px-2 mt-3 mb-1 h5">
                    Contact
                </div>

                <div class="py-1">
                    <label for="email" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre email</i></label><br>
                    <input type="text" class="p-1 rounded-1 w-100" placeholder="Email" name="email" value="<?php echo $_SESSION['email'] ?>">
                </div>

                <div class="py-1">
                    <label for="password" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer un mot de passe d'au moins 8 caractères</i></label><br>
                    <input type="password" class="p-1 rounded-1 w-100"  placeholder="Password" name="password_1" value="<?php echo substr($_SESSION['password'],0,8); ?>" >
                </div>

                <div class="py-1">
                    <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submitUserUpdate">Mettre à jour</button>
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
                    <th class="p-1">Détails</th>
                </tr>
                <?php if(!empty($orders)):  ?>
                    <?php for($i=0;$i<=isset($orders[$i]);$i++): ?>
                        <?php $date = substr($orders[$i]['date_commande'],0,10)?>
                        <tr>
                            <td ><?= $date  ?></td>
                            <td class="p-1"><?=  $orders[$i]['price'] ?> €</td>
                            <td class="p-1"><?= $orders[$i]['nom_paiement'] ?></td>
                            <td class="p-1">
                                <form method="POST" action="">
                                    <div class="mb-3 form-check">
                                        <button type="submit" class="btn btn-dark px-1 py-1 rounded-2 shadow-sm" name="detailsCommande" value="<?=  $orders[$i]['id_commande'] ?>"><b>détails</b></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endfor; ?>
                <?php else: ?>
                    <tr>
                        <th class="row p-2">
                            Vous n'avez pas encore de commande
                        </th>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </table>

    </div>

</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>




