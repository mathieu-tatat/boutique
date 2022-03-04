<?php
require('Stripe.php');
$stripe = new Stripe('sk_test_51KYOwkJL8tvfRiB6iVBSoByYQgrr44hyZljUreW2YxrkWCvMhp9VxZluhBns6ymzM6XNTtyDRDJDgJB948NZhMaD00oTlpUrON');
$stripe->api('customers/cus_90pnhgR03ma9fc', [
    'plan' => 'premium'
]);


/*
 * curl https://api.stripe.com/v1/customers/cus_90paEDoDi7CDDu/subscriptions \
   -u sk_test_z0vXJ4O3MRBZ2HMDTMmFh9gH: \
   -d plan=sapphire-extended-812
 */
