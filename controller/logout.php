<?php
//required files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/logging_in.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//instantiate a new instance of logging_in Class
    $validate = new logging_in($db);

/*.................User Logout...............................*/
if (isset($_GET['u'])){
    $user = trim($_GET['u']);
    $login_status = "Logged_Out";

    try {      // Login User...
        $data = $validate->endSession($user, $login_status);
            $response = array(
            "type" => "success",
            "message" => "Session Terminated Securely..."
            ); 
        echo '<meta http-equiv="refresh" content="5; URL=../auth/?ref=Back-Home">';  
    } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}
?>