<?php
//required file for DB
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/registering.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//Required File For API Loading
	include '../Member-Area/qrcode/phpqrcode/qrlib.php';
	require ('../Member-Area/src/Coinpayments.php');
	require ('../Member-Area/src/keys.php');
//instantiate a new instance of logging_in Class
    $validate = new registering($db);

//Geting Form Fields
 if (isset($_POST['submit'])){
 	
    $uniqueid = trim($_POST['uniqueid']); 
    $email = trim($_POST['email']); 
    $amt = trim($_POST['amt']); 
    $amount = trim($_POST['amount']); 
    $descrip = trim($_POST['descrip']);
    $ip = trim($_POST['ip']); 
    $user_agent = trim($_POST['user_agent']); 

    $validate->subPayment($uniqueid, $email, $amount, $descrip, $ip, $user_agent);
   
    $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
// Enter amount for the transaction
	$amount = $amt;
// Litecoin Testnet is a no value currency for testing
	$currency = 'BTC';
// Enter buyer email below
	$buyer_email = $email;
// Make call to API to create the transaction
	try {
	    $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email);
	} catch (Exception $e) {
	    echo 'Error: ' . $e->getMessage();
	    exit();
	}
	if ($transaction_response['error'] == 'ok') {
	    // Success!
		$output = 'GET ONE CONFIRMATION BEFORE CLOSING.' . '<br>';
		$output .= 'Send Exactly: ' . $transaction_response['result']['amount'] .'  bitcoin <br>';
		$output .= 'To This Address: ' . $transaction_response['result']['address'] . '<br>';
	} 
	  else {		// Something went wrong!
	    $output = 'Error: ' . $transaction_response['error'];
	}
}

?>