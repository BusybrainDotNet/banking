<?php
  require __DIR__.'/../model/settings_main.php';

//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();

//instantiate a new instance of Users Class
	$validate = new settings_main($db);



if (isset($_GET['ua'])) {
//Get URL inputs
	$uniqueid = trim($_GET['ua']);

	try { //GET ALL USER DATA/PROFILE
		$getUserInfo = $validate->getUserDetails($uniqueid);
		$getUserProf = $validate->getUserProfile($uniqueid);
		$getUserSub = $validate->getUserSubPay($uniqueid);
		$getUserDL = $validate->getUserDeadLine($uniqueid);
		$getUserAccount = $validate->getUserAccountDetails($uniqueid);
        $getUserCards = $validate->getUserCardInfo($uniqueid);
        $getUserCardSub = $validate->getUserCardSubInfo($uniqueid);
        $getUserTranc = $validate->getUserTrancInfo($uniqueid);
        $getUserReports = $validate->getUserReportInfo($uniqueid);
        $getUserLoan = $validate->getUserLoanInfo($uniqueid);
        $getUserOffer = $validate->getUserOfferInfo($uniqueid);
        
	} catch (Exception $e) {
		$response = array(
		"type" => "error",
    	"message" => $e->getMessage()
        );	
	}
}


if (isset($_GET['payid'])) {
//Get URL inputs
    $id = trim($_GET['payid']);
    try { //GETPAYMENT DETAILS
        $getpayInfo = $validate->getPaymentDetails($id);
        
    } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );  
    }

}

















/*.......Update User Account Information...............*/
if (isset($_POST['updateUser'])) {

    $uniqueid = trim($_POST['uniqueid']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $profile = trim($_POST['profile']);
    $status = trim($_POST['status']);
    $login_status = trim($_POST['login_status']);
    $notify = trim($_POST['notify']);

    try {     
        $result = $validate->updateUserAccount($uniqueid, $fname, $lname, $email, $username, $profile, $status, $login_status, $notify);
            $response = array(
            "type" => "success",
            "message" => "Account Information Has Been Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.......Update User Account Information...............*/
if (isset($_POST['updateProfile'])) {

    $uniqueid = trim($_POST['uniqueid']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $email1 = trim($_POST['email1']);
    $occupation = trim($_POST['occupation']);
    $number = trim($_POST['number']);
    $number1 = trim($_POST['number1']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $zipcode = trim($_POST['zipcode']);
    $licence = trim($_POST['licence']);
    $ssn = trim($_POST['ssn']);

    try {     
        $result = $validate->updateUserProfile($uniqueid, $dob, $gender, $email1, $occupation, $number, $number1, $address, $city, $country, $zipcode, $licence, $ssn);
            $response = array(
            "type" => "success",
            "message" => "Profile Information Has Been Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}


/*.......Update User Account Balalnce...............*/
if (isset($_POST['updateUserBal'])) {

    $uniqueid = trim($_POST['uniqueid']);
    $pin = trim($_POST['pin']);
    $accnum1bal = trim($_POST['accnum1bal']);
    $accnum2bal = trim($_POST['accnum2bal']);

    try {     
        $result = $validate->updateUserBalance($uniqueid, $pin, $accnum1bal, $accnum2bal);
            $response = array(
            "type" => "success",
            "message" => "Account Balance Has Been Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}


/*.......Update User Subscription Plan...............*/
if (isset($_POST['setDeadline'])) {

    $uniqueid = trim($_POST['uniqueid']);
    $expdate = trim($_POST['expdate']);
    $status = trim($_POST['status']);

    try {     
        $result = $validate->setUserDeadline($uniqueid, $expdate, $status);
            $response = array(
            "type" => "success",
            "message" => "Subscription Plan Has Been Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.......Update User Premium Payment Status...............*/
if (isset($_POST['updatePay'])) {

    $id = trim($_POST['id']);
    $status = trim($_POST['status']);

    try {     
        $result = $validate->updateSubPay($id, $status);
            $response = array(
            "type" => "success",
            "message" => "Premium Payment Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}

















/*.................Delete Subscriber...............................*/
if (isset($_POST['delsubscriber'])) {

    $id = trim($_POST['id']);

    try {     
        $result = $validate->deleteSubscriber($id);
            $response = array(
            "type" => "success",
            "message" => "Subscriber Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}

/*.................Delete Message Report...................*/
if (isset($_POST['delreport'])) {

    $id = trim($_POST['id']);

    try {    
        $result = $validate->deleteReport($id);
            $response = array(
            "type" => "success",
            "message" => "Message Report Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}

/*.................Delete Used Card...................*/
if (isset($_POST['delusedcard'])) {

    $id = trim($_POST['id']);

    try {    
        $result = $validate->deleteUsedCardInfo($id);
            $response = array(
            "type" => "success",
            "message" => "Card Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}
/*.................Delete Transaction...................*/
if (isset($_POST['deltranc'])) {

    $id = trim($_POST['id']);

    try {    
        $result = $validate->deleteTransaction($id);
            $response = array(
            "type" => "success",
            "message" => "Transaction Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}
/*.................Delete Membership Payment...................*/
if (isset($_POST['delsubpay'])) {

    $id = trim($_POST['id']);

    try {    
        $result = $validate->deleteMemberPay($id);
            $response = array(
            "type" => "success",
            "message" => "Membership Payment Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}
/*.................Delete DeadLine...................*/
if (isset($_POST['deldeadline'])) {

    $id = trim($_POST['id']);

    try {    
        $result = $validate->deleteDeadLine($id);
            $response = array(
            "type" => "success",
            "message" => "Membership Dead Line Has Been Deleted successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}
