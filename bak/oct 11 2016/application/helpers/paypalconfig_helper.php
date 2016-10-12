<?php
$currency = '$'; //Currency sumbol or code

//db settings
$db_username = 'root';
$db_password = '';
$db_name = 'secondmarketplace';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

//paypal settings
$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'eucpeliscojr-facilitator_api1.gmail.com'; //PayPal API Username
$PayPalApiPassword 		= 'FAFPU3LL9FBGW82V'; //Paypal API password
$PayPalApiSignature 	= 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-AAk1TXYPhq.VtefO5UGC1JRQR-sZ'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://localhost/projects/PHP-Shopping-Cart/paypal-express-checkout/process.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://localhost/projects/PHP-Shopping-Cart/paypal-express-checkout/cancel_url.html'; //Cancel URL if user clicks cancel

?>