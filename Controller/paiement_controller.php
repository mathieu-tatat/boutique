<?php
require_once("Model/Stripe.php");
require_once('Model/Paiement.php');
require_once('Model/Cart.php');
require_once('Model/User.php');
require_once('Model/Produit.php');

if(!isset($_SESSION['connected']))
{
    header('location:connexion.php');  // if the hash doesn't match
    exit();
}  

if(isset($_POST['paiement']))
{

    // $token = htmlspecialchars($_POST['stripeToken']);
    $name = htmlspecialchars($_POST['name']);
    $total = htmlspecialchars($_SESSION["totalCommande"]);
    $cardNumber1 = htmlspecialchars($_POST['number1']);
    $cardNumber2 = htmlspecialchars($_POST['number2']);
    $cardNumber3 = htmlspecialchars($_POST['number3']);
    $cardNumber4 = htmlspecialchars($_POST['number4']);
    $expMonth = htmlspecialchars($_POST['exp_month']);
    $expYear = htmlspecialchars($_POST['exp_year']);
    $cvc = htmlspecialchars($_POST['cvc']);


    // if (empty($token)) { array_push($_SESSION['errors'], "Token invalide"); }
    if (empty($name))                                   { array_push($_SESSION['errors'], "Veuillez renseigner un nom"); }    
    if (empty($total))                                  { array_push($_SESSION['errors'], "le total est invalide"); }
    if (!preg_match('/^[0-9]{4}$/', $cardNumber1) )     { array_push($_SESSION['errors'], "le numéro de carte est invalide"); }
    if (!preg_match('/^[0-9]{4}$/', $cardNumber2) )     { array_push($_SESSION['errors'], "le numéro de carte est invalide"); }
    if (!preg_match('/^[0-9]{4}$/', $cardNumber3) )     { array_push($_SESSION['errors'], "le numéro de carte est invalide"); }
    if (!preg_match('/^[0-9]{4}$/', $cardNumber4) )     { array_push($_SESSION['errors'], "le numéro de carte est invalide"); }
    if (!preg_match('/^[0-9]{2}$/', $expMonth) )        { array_push($_SESSION['errors'], "expire Month est invalide"); }
    if (!preg_match('/^[0-9]{2}$/', $expYear) )         { array_push($_SESSION['errors'], "expire Year est invalide"); }
    if (!preg_match('/^[0-9]{3}$/', $cvc) )             { array_push($_SESSION['errors'], "CVC est invalide"); }

    if(count($_SESSION['errors']) == 0) 
    {
        // require('Stripe.php');
        // $stripe = new Stripe('sk_test_51KYOwkJL8tvfRiB6iVBSoByYQgrr44hyZljUreW2YxrkWCvMhp9VxZluhBns6ymzM6XNTtyDRDJDgJB948NZhMaD00oTlpUrON');
        
        // $customer = $stripe->api('customers', [
        //     'source' => $token,
        //     'description' => $name,

        // ]);

        // $charge = $stripe->api('charges', [
        //     'amount' => $total,
        //     'currency' => 'eur',
        //     'customer' => $customer->id
        // ]);
        $produit = new Produits();
        foreach ($_SESSION['infosProduitsDansPanier'] as $infoProduit)
        {
            $produit->reduceQuantity($infoProduit[1],$infoProduit[0]);
        }
        $paiement = new Paiement();
        $paiement->createCBPayment($_SESSION["cart"]["id_panier"]);
        $cart = new Cart();
        $cart->createCart($_SESSION['id']);
        $user = new User();
        $_SESSION['cart'] = $user->getCartId($_SESSION['id']);
        array_push($_SESSION['errors'], "Bravo votre paiement a bien été enregistré");
        header('location: profil.php');

    }

}
