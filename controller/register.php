<?php
//mandatories files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/registering.php';

//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();

//instantiate a new instance of Users Class
	$validate = new registering($db);



if (isset($_POST['cont'])) {

//Get form inputs
	$user_agent = trim($_POST['user_agent']);
	$ip = trim($_POST['ip']);
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$hash = md5(rand(0,1000) );
// Derive the code by shuffle...
	$length = 5;
  $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$code = substr(str_shuffle($chars), 0, $length);
	//$code = base64_encode($newcode);
	$username = $fname.$code;
	$uniqueid = 'SBLCuser'.$code;
	try {
		// Register A User And Send Confirmation Email...
		$data = $validate->validateUser($fname, $lname, $username, $uniqueid, $email, $hash, $code, $ip, $user_agent);
					$response = array(
					"type" => "success",
					"message" => "Successful, You Can Now Check Your Email To Continue... <i class='fa fa-spinner fa-spin'></i>"
						);	
	} catch (Exception $e) {
		$response = array(
		"type" => "error",
    	"message" => $e->getMessage()
        );	
	}

}
