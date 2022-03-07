<?php
$token = $_POST['stripeToken'];
$name = $_POST['name'];
$total = $_POST['total'];
if(isset($total) && !empty($name) && !empty($token)) {
    require('Stripe.php');
    $stripe = new Stripe('sk_test_51KYOwkJL8tvfRiB6iVBSoByYQgrr44hyZljUreW2YxrkWCvMhp9VxZluhBns6ymzM6XNTtyDRDJDgJB948NZhMaD00oTlpUrON');
    $customer = $stripe->api('customers', [
        'source' => $token,
        'description' => $name,

    ]);
    $charge = $stripe->api('charges', [
        'amount' => 3000,
        'currency' => 'eur',
        'customer' => $customer->id
    ]);
    $tonton = var_dump($charge);
    die('Bravo votre paiement a bien été enregistré');
} ?>

<pre><?= var_dump($tonton) ?></pre>


<!--
4242 4242 4242 4242   Paiement validé immédiatement
4000 0025 0000 3155   Active 3D Secure
4000 0000 0000 9995   Echoue sur "Fonds insuffisants"
-->
