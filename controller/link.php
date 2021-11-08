<?php
//required files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/registering.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//instantiate a new instance of registering Class
    $validate = new registering($db);

/*.................User Login...................................*/
if (isset($_POST['cont'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    try {      // Login User...
        $data = $validate->firstTimeUser($user);
        $response = array(
        "type" => "success",
        "message" => "Account Validated, Set Your Password."
        ); 
        echo '<meta http-equiv="refresh" content="3; URL=../auth/set-pass?u='.$user.'">';

        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}



/*.................First Time Pass Set...................................*/
if (isset($_POST['firsttime'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    try {      // Login User...
        $data = $validate->firstTimePass($user, $password, $cpassword);
        $response = array(
        "type" => "success",
        "message" => "Online Banking Password Successfully Updated.<br>You Can Now Login Now But Always Remember To Stay Safe Online..."
        ); 
        echo '<meta http-equiv="refresh" content="5; URL=../auth/">';
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}




/*.................User Login...................................*/
if (isset($_POST['resetpass'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    try {      // Login User...
        $data = $validate->resetPass($user, $password, $cpassword);
        $response = array(
        "type" => "success",
        "message" => "Online Banking Password Successfully Updated.<br>You Can Now Login Now But Always Remember To Stay Safe Online..."
        ); 
        echo '<meta http-equiv="refresh" content="5; URL=../auth/">';
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}




/*.................Activation Link...................................*/
if (isset($_POST['activate'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $email = trim($_POST['uniqueid']);
    try {      // Login User...
        $data = $validate->activateUser($user, $email);
        $response = array(
        "type" => "success",
        "message" => "All Looks Good, A Link Has Been Sent To Your Registered Email<br>Go To Your Email Or Spam Folder To Continue."
        ); 
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}


/*.................Help Logging In...................................*/
if (isset($_POST['loginhelp'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    try {      // Login User...
        $data = $validate->helpUserLogin($user);
        $response = array(
        "type" => "success",
        "message" => "All Looks Good, Let Us Know Its Really You."
        ); 
        echo '<meta http-equiv="refresh" content="3; URL=../auth/logn-help.php?ref=Log In Help">';

        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}



//Need Help Logging Users In (Security Questions Confirmation)
if (isset($_POST['finalhelp'])) {
    $uniqueid = $_SESSION['uniqueid'];
    $seca1 = $_SESSION['seca1'];
    $answer = trim($_POST['answer']);

    if (($answer == $seca1)) {
        $response = array(
        "type" => "success",
        "message" => "All Looks Good...You will Be Redirected..."
        );
        echo '<meta http-equiv="refresh" content="3; URL=../auth/logout.php?ref=Help Logging In&u='.$uniqueid.'">';  
    }else{
        $response = array(
        "type" => "error",
        "message" => "You Provided An Incorrect Answer, Try Again..."
        );
    } 
}



