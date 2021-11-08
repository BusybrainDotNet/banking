<?php
//mandatories files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/registering.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//instantiate a new instance of registering Class
	  $validate = new registering($db);

if (isset($_GET['h']) && isset($_GET['u'])) {
//Get form inputs
	$uniqueid = trim($_GET['u']);
	$username = trim($_GET['u']);
	$acc1 = mt_rand(100000,99999999);
    $acc2 = mt_rand(200000,99999999);
    $pin = mt_rand(10101,90910);
	$hash = md5(rand(0,1000));

    $accnum1 = '102100'.$acc1;
    $accnum2 = '102911'.$acc2;

	try {
		// Register A User And Send Confirmation Email...
		$data = $validate->setUpUser($uniqueid, $username, $accnum1, $accnum2, $pin, $hash);
		$response = array(
    		"type" => "success",
    		"message" => "Your Account Is Now Confirmed<br><br>Continue To Account Set Up..."
			);
		echo '<meta http-equiv="refresh" content="3; URL=../auth/verify1?h='.$hash.'&u='.$uniqueid.'&'.$hash.'&u='.$username.'">';	
	} catch (Exception $e) {
		$response = array(
			"type" => "error",
    	"message" => $e->getMessage()
    );
        echo '<meta http-equiv="refresh" content="3; URL=../auth/verify1?u='.$uniqueid.'">';	
	}
	//echo '<meta http-equiv="refresh" content="5; URL=../login/">';
}



    
/*.................User Account Setup...............................*/
if (isset($_POST['verifyi'])) {
//Get form inputs
    $uniqueid = trim($_POST['uniqueid']);
    $gender = trim($_POST['gender']);
    $licence = trim($_POST['licence']);
    $ssn = trim($_POST['ssn']);
     // location where initial upload will be moved to
// File fullname
    $filename = $_FILES['idfront']['name'];

    // Location
    $target_file = '../auth/Uploads/'.$filename;

    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // Valid image extension
    $valid_extension = array("jpg","jpeg","png");

    if(in_array($file_extension, $valid_extension)){
        
       // Upload file
      if(move_uploaded_file($_FILES['idfront']['tmp_name'],$target_file)){

    try {      // Login User...
        $data = $validate->verifyUser($uniqueid, $gender, $licence, $ssn, $filename);
            $response = array(
            "type" => "success",
            "message" => "Successful <br><br>You Will Get A Notification When Your Identity Is Confirmed"
            );
            echo '<meta http-equiv="refresh" content="5; URL=../auth/bwl_initpwd?u='.$uniqueid.'">';
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
	    }
		}
	}
}

