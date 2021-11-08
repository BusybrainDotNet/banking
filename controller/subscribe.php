<?php
//mandatories files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/subscriber.php';

//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();

//instantiate a new instance of Users Class
	$validate = new subscriber($db);

if (isset($_POST['sub'])) {
//Get form inputs
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$user_agent = trim($_POST['user_agent']);
  $ip = trim($_POST['ip']);

	try {
		$data = $validate->newsub($ip, $email, $name, $user_agent);
				$response = array(
				"type" => "success",
				"message" => "You're Now Subscribed To Financial Dose<br><br>Check Your Email For Confirmation..."
				);
	} catch (Exception $e) {
		$response = array(
		"type" => "error",
    	"message" => $e->getMessage()
        );		
	}
}
?>