<?php $title = "paiement" ?>
<?php session_start() ?>


<?php require_once ('Controller/paiement_controller.php'); ?>
<?php require_once('Model/Produit.php'); ?>

<?php ob_start() ?>

    <div class="container-xl px-4 my-4 border border-secondary border-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de produit</th>
                    <th>Quantité</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
        <?php $produit = new Produits(); 
                foreach ($_SESSION['infosProduitsDansPanier'] as $infoProduit) : ?>
            <tr>
                <td><?= $produit->getNomById($infoProduit[0])?></td>
                <td><?= $infoProduit[1] ?></td>
                <td><?= ($produit->getUnitPriceById($infoProduit[0]))*$infoProduit[1] ?> €</td>
            </tr>
        <?php   endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container-xl px-4 my-4 border border-secondary border-1">

        <!-- formulaire paiement -->
        <form class="d-flex flex-column justify-content-center align-items-center my-3" id="payment_form" method="POST">

            <p class="trait_dessus">Paiement</p>

            <div class="row p-1 my-1">
                <label for="montant">Montant:</label>
                <p id="montant"><?= $_SESSION["totalCommande"]?></p>
            </div>

            <div class="row p-1 my-1">
                <label for="nom">Nom de la carte:</label>
                <input type="text" name="name" placeholder="Votre nom" id="nom">
            </div>

            <div class="row d-flex flex-column p-1 my-1">
                <label>numero de carte:</label>
                <div class="d-flex">
                    <input type="text" placeholder="xxxx" name="number1" maxlength="4">
                    <input type="text" placeholder="xxxx" name="number2" maxlength="4">
                    <input type="text" placeholder="xxxx" name="number3" maxlength="4">
                    <input type="text" placeholder="xxxx" name="number4" maxlength="4">
                </div>
            </div>

            <div class="row p-1 my-1">                
                    <label>Month:</label>
                    <input type="text" placeholder="MM" name="exp_month" value="10" name="month" class="col-md-2">
                

                
                    <label>Year:</label>
                    <input type="text" placeholder="YY" name="exp_year" value="22" name="year " class="col-md-2">
                

                
                    <label>Security:</label>
                    <input type="text" placeholder="CVC" name="cvc" value="123" name="cvc" class="col-md-2">   
            </div>

            <button class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm p-0 my-1" type="submit" name="paiement">Acheter</button>

        </form>
    </div>

<?php $content = ob_get_clean() ?>

<?php require ('View/Patron.php'); ?>