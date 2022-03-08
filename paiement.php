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
        <?php $produit = new Produits(); foreach ($_SESSION['infosProduitsDansPanier'] as $infoProduit) : ?>
            <tr>
                <td><?= $produit->getNomById($infoProduit[0])?></td>
                <td><?= $infoProduit[1] ?></td>
                <td><?= ($produit->getUnitPriceById($infoProduit[0]))*$infoProduit[1] ?> €</td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="ui main container ">

        <!-- recap panier -->
        <div recapPanier>

        </div>

        <!-- formulaire paiement -->
        <form class="ui form containerForm" id="payment_form" method="POST">

            <p class="trait_dessus">Paiement</p>

            <div class="field">
                <label for="montant">Montant:</label>
                <p id="montant"><?= $_SESSION["totalCommande"]?></p>
            </div>

            <div class="field">
                <label for="nom">Nom de la carte:</label>
                <input type="text" name="name" placeholder="Votre nom" id="nom">
            </div>

            <div class="field">
                <label>numero de carte:</label>
                <!-- <input type="text" placeholder="xxxx xxxx xxxx xxxx" data-stripe="number" value="4242 4242 4242 4242" id="numCarte"> -->
                <input type="text" placeholder="xxxx" name="number1">
                <input type="text" placeholder="xxxx" name="number2">
                <input type="text" placeholder="xxxx" name="number3">
                <input type="text" placeholder="xxxx" name="number4">
            </div>

            <div class="verification">

              <div class="field mounth">
                <label>Month:</label>
                <!-- <input type="text" placeholder="MM" data-stripe="exp_month" value="10" name="month" > -->
                <input type="text" placeholder="MM" name="exp_month" value="10" name="month" >
              </div>

              <div class="field mounth">
                <label>Year:</label>
                  <!-- <input type="text" placeholder="YY" data-stripe="exp_year" value="22" name="year"> -->
                  <input type="text" placeholder="YY" name="exp_year" value="22" name="year">
              </div>

              <div class="field mounth">
                <label>Security:</label>
                  <!-- <input type="text" placeholder="CVC" data-stripe="cvc" value="123" name="cvc"> -->
                  <input type="text" placeholder="CVC" name="cvc" value="123" name="cvc">
              </div>

            </div>

            <button type="submit" name="paiement">Acheter</button>

        </form>
    </div>

    <pre><?= var_dump($_SESSION) ?></pre>
    <pre><?= var_dump($_POST) ?></pre>
    <pre><?= var_dump($_GET) ?></pre>

<!-- 
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        Stripe.setPublishableKey('pk_test_51KYOwkJL8tvfRiB64nhKjeqkVHi6F823LC3raSzHEAxBs3irDtFcfqkI1WhkobOThPnWpW2mUvzU785IVWwiENsZ00Hw7R1sPy')
        var $form = $('#payment_form')
        $form.submit(function (e) {
            e.preventDefault()
            $form.find('.button').attr('disabled', true)
            Stripe.card.createToken($form, function (status, response) {
                if (response.error) {
                    $form.find('.message').remove();
                    $form.prepend('<div class="ui negative message"><p>' + response.error.message + '</p></div>');
                    $form.find('.button').attr('disabled', false)
                } else {
                    var token = response.id
                    $form.append($('<input type="hidden" name="stripeToken">').val(token))
                    $form.get(0).submit()
                }
            })
        })
    </script> -->
    


<?php $content = ob_get_clean() ?>

<?php require ('View/Patron.php'); ?>

<!--
4242 4242 4242 4242   Paiement validé immédiatement
4000 0025 0000 3155   Active 3D Secure
4000 0000 0000 9995   Echoue sur "Fonds insuffisants"
-->