<php session_start()
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="paiementStyle.css">
</head>
<body class="paimentForm">
    <div class="ui main container ">

      <div recapPanier>

      </div>
        <form action="confirmation.php" class="ui form containerForm" id="payment_form" method="post">

            <p class="trait_dessus">Paiement</p>
            <div class="field"><label for="nom">Montant:</label>
                <input type="text" name="total" value="$total->panier €">
            </div>
            <div class="field"><label for="nom">Nom de la carte:</label>
                <input type="text" name="name" required placeholder="Votre nom" value="$user->name">
            </div>
            <div class="field"><label for="nom">numero de carte:</label>
                <input type="text" placeholder="xxxx xxxx xxxx xxxx" data-stripe="number" value="4242 4242 4242 4242">
            </div>
            <div class="verification">
              <div class="field mounth">
                <label>Month:</label>
                  <input type="text" placeholder="MM" data-stripe="exp_month" value="10" name="month" >
              </div>
              <div class="field mounth">
                <label>Year:</label>
                  <input type="text" placeholder="YY" data-stripe="exp_year" value="22" name="year">
              </div>
              <div class="field mounth">
                <label>Security:</label>
                  <input type="text" placeholder="CVC" data-stripe="cvc" value="123" name="cvc">
              </div>
            </div>
            <p class>
                <button class="ui buttonPaye button" type="submit">Acheter</button>
            </p>
        </form>
    </div>

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
    </script>
</body>
</html>
