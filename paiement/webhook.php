<?php
http_response_code(200);

require('Stripe.php');
$stripe = new Stripe('sk_test_51KYOwkJL8tvfRiB6iVBSoByYQgrr44hyZljUreW2YxrkWCvMhp9VxZluhBns6ymzM6XNTtyDRDJDgJB948NZhMaD00oTlpUrON');
$input = file_get_contents('php://input');
$event = json_decode($input);
$event = $stripe->api("events/{$event->id}");
var_dump($event);

// Traitement PHP par rapport à l'évènement
