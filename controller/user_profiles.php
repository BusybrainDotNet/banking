<?php
//required files
  require __DIR__.'/../model/user_profile.php';

    $validate = new user_profile($db);
  
/*.................User Profile............................*/
if (isset($_SESSION['uniqueid'])) {

	$user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userProfile($user);
            
        } catch (Exception $e) {
        $response1 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
}
/*.................User Account Details.................*/
if (isset($_SESSION['uniqueid'])) {

  $user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userAccount($user);
            
        } catch (Exception $e) {
        $response5 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
}  
/*.................User Security.........................*/
if (isset($_SESSION['uniqueid'])) {

  $user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userSecurity($user);
            
        } catch (Exception $e) {
        $response3 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
} 
/*.................User 2FA Security.........................*/
if (isset($_SESSION['uniqueid'])) {

  $user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->user2faSecurity($user);
            
        } catch (Exception $e) {
        $response4 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
}
/*.................User Subscribption Alert.........................*/
if (isset($_SESSION['uniqueid'])) {

  $user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userSubAlert($user);
            
        } catch (Exception $e) {
        $response2 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}
/*.................New User Trial/Grace Perod.............*/
if (isset($_SESSION['uniqueid'])) {

  $user = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->trialPeriod($user);
            
        } catch (Exception $e) {
        $response6 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}
/*.................User Card Apply Status.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->cardApply($uniqueid);
            
        } catch (Exception $e) {
        $response7 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
} 

/*.................Promotional Offers.................*/
if (isset($_SESSION['uniqueid'])) {

    try {      // User Profile...
        $data = $validate->offers();
            
        } catch (Exception $e) {
        $response8 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
} 

/*.................Promotional Offers.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->offersApply($uniqueid);
            
        } catch (Exception $e) {
        $response9 = array(
        "type" => "success",
        "message" => $e->getMessage()
        );  
    }
} 


/*.................Membership Status.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->memberStatus($uniqueid);
            
        } catch (Exception $e) {
        $response10 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
} 

/*.................Users Transactions.................*/
if ((isset($_SESSION['uniqueid'])) && (isset($_GET['a']))) {

  $sendacc = $_GET['a'];
  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
         $validate->userTransactionCheck($uniqueid, $sendacc);
         $trancData = $validate->userTransactionHistory($uniqueid, $sendacc);
      
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
} 


/*.................Transaction Status.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try { 
          $validate->userTransactions($uniqueid);   
        } catch (Exception $e) {
        $response11 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
} 



/*.................Primary Transaction Status.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userPrimaryTransactions($uniqueid);
            
        } catch (Exception $e) {
        $response13 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
} 




/*.................Heritage Transaction Status.................*/
if (isset($_SESSION['uniqueid'])) {

  $uniqueid = $_SESSION['uniqueid'];

    try {      // User Profile...
        $data = $validate->userHeritageTransactions($uniqueid);
            
        } catch (Exception $e) {
        $response14 = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }
}  









/*$response = array(
            "type" => "success",
            "message" => "Successful<br><br>You Will Be Redirected...<i class='fa fa-spinner fa-spin'></i>"
            );*/

