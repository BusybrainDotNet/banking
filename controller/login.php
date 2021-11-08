<?php
//required files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/logging_in.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//instantiate a new instance of logging_in Class
    $validate = new logging_in($db);

    
/*.................User Login...................................*/
if (isset($_POST['login'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $code = mt_rand(101010,900909);
    $lastlogin = date('Y-m-d H:i:s');
    $login_status = 'Logged_in';
    $user_agent = trim($_POST['user_agent']);
    $ip = trim($_POST['ip']);
    try {      // Login User...
        $data = $validate->validateUser($user, $password, $code, $login_status, $lastlogin, $ip, $user_agent);
            $response = array(
            "type" => "success",
            "message" => "Successful<br><br>You Will Be Redirected...<i class='fa fa-spinner fa-spin'></i>"
            );
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}


/*.................User Password Reset....................*/
if (isset($_POST['find'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    try {      // Login User...
        $data = $validate->passRequest($user);
            $response = array(
            "type" => "success",
            "message" => "Successful<br><br>Check Your Email For A Password Reset Link..."
            );   
    } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}



/*.................User Verification Code..............*/
  if (isset($_POST['unlock'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $code = trim($_POST['code']);
    try {      // Login User...
        $data = $validate->authenticate($user, $code);
            $response = array(
            "type" => "success",
            "message" => "Successful<br><br>You Will Be Redirected To Your Dashboard... <i class='fa fa-spinner fa-spin'></i>"
            );   
    } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}



