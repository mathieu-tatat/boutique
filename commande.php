<?php $title = "Détails de la commande" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Contient.php'); ?>
<?php require_once('Model/Produit.php'); ?>
<?php require_once('Model/Commande.php'); ?>

<?php require_once('Controller/user_controller.php');   // Models : User  &  Cart  ?>
<?php require_once('Controller/commande_controller.php'); // Models : User  &  Cart  &  Contient  &  Produits  &  Commandes ?>


<?php   ob_start();  ?>

<div class="d-flex flex-row justify-content-center align-items-center">

    
    <div class="shadow-sm p-5 mb-5 border border-light border-1 px-4 mt-4">
        <div class="h5 mb-3">
            Commande n. <?= $id_comm; ?><br>
            <span class="h6">
               date : <?= $comm[0]['date_commande'] ?>
                </span>
        </div>
         <?php if(isset($_SESSION['connected']) and isset($comm)): ?>
             <table class="table p-3">
             <?php  $tot=0; ?>
                <tbody class="">
                    <tr>
                        <th class="p-3">Produit</th>
                        <th class="p-3">Qté</th>
                        <th class="p-3">Prix Total</th>
                        <th class="p-3">Date</th>
                    </tr>
                    <?php for($i=0;$i<=isset($comm[$i]);$i++): $tot+=$comm[$i]['price'];?>
                    <tr>
                        <td class="p-3"><?= substr($comm[$i]['nom_produit'],0,60)?>...</td>
                        <td class="p-3"><?= $comm[$i]['quantité'] ?></td>
                        <td class="p-3 text-nowrap"><?= $comm[$i]['price'] ?> €</td>
                        <td class="p-3"><?= substr($comm[$i]['date_commande'],0,16) ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
        </table>
        <div class="mb-3 py-3 h6">
            Prix total de la commande : <?= $tot ?> €<br>
            Payé avec : <?= $comm[0]['nom_paiement'] ?>
        </div>
        <?php else: ?>
        <div>
            <b class="lead"> you don't have any order yet </b>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>