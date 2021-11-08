<?php
//required files
  require __DIR__.'/../model/users_main.php';
  require __DIR__.'/../model/reporters.php';


    $validate = new users_main($db);




/*.................Update Username...............................*/
if (isset($_POST['usernameupdate'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $username = trim($_POST['username']);

    try {      // Login User...
        $data = $validate->updateUsername($user, $username);
            $response = array(
            "type" => "success",
            "message" => "User Name Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.................Update Full Name...................*/
if (isset($_POST['fullnameupdate'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);

    try {      // Login User...
        $data = $validate->updateFullname($user, $fname, $lname);
            $response = array(
            "type" => "success",
            "message" => "Your Name Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}





/*.................Update Password..................*/
if (isset($_POST['passwordupdate'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $password = trim($_POST['password']);
    $oldpassword = trim($_POST['oldpassword']);

    try {      // Login User...
        $data = $validate->updatePassword($user, $password, $oldpassword);
            $response = array(
            "type" => "success",
            "message" => "Password Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}




/*.................Update Number...................*/
if (isset($_POST['updatenumber'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $number = trim($_POST['number']);
    $number1 = trim($_POST['number1']);

    try {      // Login User...
        $data = $validate->updateNumber($user, $number, $number1);
            $response = array(
            "type" => "success",
            "message" => "Your Number Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}




/*.................User Reports...................*/
if (isset($_POST['sendmsg'])) {
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

//instantiate a new instance of Users Class
    $reportvalidate = new reporters($db);

 try {      // Login User...
        $data = $reportvalidate->newreport($fname, $lname, $email, $number, $subject, $details, $ip, $status, $user_agent);
                $response = array(
                "type" => "success",
                "message" => "Successful,Thank You For Your Submission, You Will Get a Response soon..."
                );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.................Update 2FA Notification...................*/
if (isset($_POST['notifyon'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);

    try {      // Login User...
        $data = $validate->update2faAlert($user);
            $response = array(
            "type" => "success",
            "message" => "2FA Alerts Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}

/*.................Update 2FA Notification...................*/
if (isset($_POST['notifyoff'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $notify = trim($_POST['notify']);

    try {      // Login User...
        $data = $validate->update2faAlert($user, $notify);
            $response = array(
            "type" => "success",
            "message" => "2FA Alerts Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}




/*.................Update Alternate Email...................*/
if (isset($_POST['updatealtemail'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $email1 = trim($_POST['email1']);

    try {      // Login User...
        $data = $validate->updateAltEmail($user, $email1);
            $response = array(
            "type" => "success",
            "message" => "Alternate Email Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}




/*.................Update Security Questions...................*/
if (isset($_POST['securityupdate'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $secq1 = trim($_POST['secq1']);
    $seca1 = trim($_POST['seca1']);
    $secq2 = trim($_POST['secq2']);
    $seca2 = trim($_POST['seca2']);

    try {      // Login User...
        $data = $validate->updateSecurity($user, $secq1, $seca1, $secq2, $seca2);
            $response = array(
            "type" => "success",
            "message" => "Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}





/*.................Update Address...................*/
if (isset($_POST['updateadd'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $zipcode = trim($_POST['zipcode']);
    $country = trim($_POST['country']);

    try {      // Login User...
        $data = $validate->updateAdd($user, $address, $city, $zipcode, $country);
            $response = array(
            "type" => "success",
            "message" => "Address Updated successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.................Get Intrapay Account Name...................*/
if (isset($_GET['intrapay'])) {
//Get form inputs
    $uniqueid = trim($_GET['recaccname']);

    try {      // Login User...
        $userinfo = $validate->getAccDetails($uniqueid);
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



/*.................Get Intrapay Account Name...................*/
if (isset($_POST['verifyTranc'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $trancid = trim($_POST['trancid']);
    $sendacc = trim($_POST['sendacc']);
    $cardnum = trim($_POST['recaccnum']);
    $recaccbank = trim($_POST['recaccbank']);
    $receiver = trim($_POST['recaccname']);
    $recaccname = trim($_POST['recaccname']);
    $amount = trim($_POST['amount']);
    $bal = trim($_POST['bal']);
    $pin = trim($_POST['pin']);
    $tranctype = trim($_POST['tranctype']);

    try {      // Login User...
        $data = $validate->insertTrancDetails($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $recaccbank, $pin, $bal, $recaccname);
            $response = array(
            "type" => "success",
            "message" => "Transaction Initiated Successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}


/*.................Credit Card Top Up...................*/
if (isset($_POST['topup'])) {
//Get form inputs
    $user = trim($_POST['user']);
    $sendacc = trim($_POST['sendacc']);
    $trancid = trim($_POST['trancid']);
    $receiver = trim($_POST['receiver']);
    $cardnum = trim($_POST['cardnum']);
    $amount = trim($_POST['amount']);
    $cvv = trim($_POST['cvv']);
    $bal = trim($_POST['bal']);
    $recaccbank = trim($_POST['recaccbank']);
    $pin = trim($_POST['pin']);
    $tranctype = trim($_POST['tranctype']);
    $expmonth = trim($_POST['expmonth']);
    $expyear = trim($_POST['expyear']);
    $ip = trim($_POST['ip']);
    $user_agent = trim($_POST['user_agent']);

    try {      // Login User...
        $data = $validate->cardTopup($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $cvv, $pin, $expmonth, $recaccbank, $expyear, $ip, $user_agent, $bal);
            $response = array(
            "type" => "success",
            "message" => "Transaction Initiated Successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}



    
/*.................User Profile Image...............................*/
if (isset($_POST['uploadpics'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
// File fullname
    $filename = $_FILES['profileimage']['name'];
    // Location
    $target_file = '../../onbank-user/Uploads/'.$filename;
    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
    // Valid image extension
    $valid_extension = array("jpg","jpeg","png");
    if(in_array($file_extension, $valid_extension)){
       // Upload file
      if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target_file)){
    try {      // Login User...
        $data = $validate->uploadUserImg($user, $filename);
            $response = array(
            "type" => "success",
            "message" => "Upload successfull..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
            }
        }
    }else{
            $response = array(
            "type" => "error",
            "message" => "Something Is Not Right... Try Again"
            ); 
        }
}







/*.................User ID Image...............................*/
if (isset($_POST['uploadidfront'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
// File fullname
    $filename = $_FILES['idfront']['name'];
    // Location
    $target_file = '../../onbank-user/Uploads/'.$filename;
    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
    // Valid image extension
    $valid_extension = array("jpg","jpeg","png");
    if(in_array($file_extension, $valid_extension)){
       // Upload file
      if(move_uploaded_file($_FILES['idfront']['tmp_name'],$target_file)){
    try {      // Login User...
        $data = $validate->uploadIdfront($user, $filename);
            $response = array(
            "type" => "success",
            "message" => "Front View Upload successfully..."
            );
        echo '<meta http-equiv="refresh" content="3; URL=id-confirm?ref=Continue To Verification">';
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
            }
        }
    }else{
            $response = array(
            "type" => "error",
            "message" => "Something Is Not Right... Try Again"
            ); 
        }
}





/*.................User ID Image...............................*/
if (isset($_POST['uploadidback'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
// File fullname
    $filename = $_FILES['idback']['name'];
    // Location
    $target_file = '../../onbank-user/Uploads/'.$filename;
    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);
    // Valid image extension
    $valid_extension = array("jpg","jpeg","png");
    if(in_array($file_extension, $valid_extension)){
       // Upload file
      if(move_uploaded_file($_FILES['idback']['tmp_name'],$target_file)){
    try {      // Login User...
        $data = $validate->uploadIdback($user, $filename);
            $response = array(
            "type" => "success",
            "message" => "Back View Upload successfully..."
            );
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
            }
        }
    }else{
            $response = array(
            "type" => "error",
            "message" => "Something Is Not Right... Try Again"
            ); 
        }
}






/*.................Deactivate Account...................*/
if (isset($_POST['deleteaccount'])) {
//Get form inputs
    $user = trim($_POST['uniqueid']);
    $password = trim($_POST['password']);
    $login_status = "Logged_out";
    $status = "Deactivated";

    try {      // Login User...
        $data = $validate->deleteAcc($user, $password, $status, $login_status);
            $response = array(
            "type" => "success",
            "message" => "successfull, Your Account Will Be Deleted In Five Minutes..."
            );
            echo '<meta http-equiv="refresh" content="10; URL=../../?ref=Deleted Account">';
        } catch (Exception $e) {
                $response = array(
                "type" => "error",
                "message" => $e->getMessage()
                );  
        }
}

