<?php
//mandatories files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/reporters.php';

//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();

//instantiate a new instance of Users Class
	$validate = new reporters($db);

if (isset($_POST['report'])) {
//Get form inputs
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$number = trim($_POST['number']);
	$subject = trim($_POST['subject']);
	$details = trim($_POST['details']);
	$user_agent = trim($_POST['user_agent']);
  $ip = trim($_POST['ip']);
  $status = "Unread";

	try {
		$validate->newreport($fname, $lname, $email, $number, $subject, $details, $ip, $status, $user_agent);
				$response = array(
				"type" => "success",
				"message" => "Successful,Thank You For Your Submission, You Will Get a Response If Necessary"
				);
	} catch (Exception $e) {
		$response = array(
		"type" => "error",
    	"message" => $e->getMessage()
        );		
	}
}
?>