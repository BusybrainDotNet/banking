<?php
/**
 * 
 */
class users_main
{
	//Database Connection
		private $con;
	//Function to construct pdo interface for connection
		public function __construct($db)
		{
			$this->con = $db;
			$this->created = date("y-m-d H:i:s");
		}



//Function to Upldate Profile Picture
    public function uploadUserImg($user, $filename){
	  $query = "UPDATE profile SET `profileimage` = :profileimage WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':profileimage', $filename);
	  $user = $sql->execute([ ':uniqueid' => $user, ':profileimage' => $filename ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Upload Error...");
			}
	  
	}



//Function to Update ID Front
    public function uploadIdfront($user, $filename){
	  $query = "UPDATE profile SET `idfront` = :idfront WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':idfront', $filename);
	  $user = $sql->execute([ ':uniqueid' => $user, ':idfront' => $filename ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Upload Error...");
			}
	  
	}



//Function to Update ID Front
    public function uploadIdback($user, $filename){
	  $query = "UPDATE profile SET `idback` = :idback WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':idback', $filename);
	  $user = $sql->execute([ ':uniqueid' => $user, ':idback' => $filename ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Upload Error...");
			}
	}


//Function to Update User Name
    public function updateUsername($user, $username){
	  $query = "UPDATE users SET `username` = :username WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':username', $username);
	  $user = $sql->execute([ ':uniqueid' => $user, ':username' => $username ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Upload Error...");
			}
	}


//Function to Update Full Name
    public function updateFullname($user, $fname, $lname){
	  $query = "UPDATE users SET `fname` = :fname, `lname` = :lname WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':fname', $fname);
	  $sql->bindParam(':lname', $lname);
	  $user = $sql->execute([ ':uniqueid' => $user, ':fname' => $fname, ':lname' => $lname ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Name Could Not Be Updated...");
			}
	}


//Function to Update User Password
    public function updatePassword($user, $password, $oldpassword){
    	$query = "SELECT password FROM users WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  //$RowCount = $stmt->rowCount();

	  if (password_verify($oldpassword, $data['password'])) {
	  		$query = "UPDATE users SET `password` = :password WHERE uniqueid = :uniqueid";
			  $sql = $this->con->prepare($query);
			  $sql->bindParam(':uniqueid', $user);
			  $sql->bindParam(':password', $password);
			  $data1 = $sql->execute([ ':uniqueid' => $user, ':password' => password_hash($password, PASSWORD_DEFAULT) ]);
	  // Checking all User credentials...
	        if ($data1 == false) {
	        	throw new Exception("Password Could Not Be Updated...");
			}
	  }else{
	  	throw new Exception("Old Password Does Not Match Our Records...");
	  	
	  }
	  
	}



//Function to Update Phone Number
    public function updateNumber($user, $number, $number1){
	  $query = "UPDATE profile SET `number` = :number, `number1` = :number1 WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':number', $number);
	  $sql->bindParam(':number1', $number1);
	  $user = $sql->execute([ ':uniqueid' => $user, ':number' => $number, ':number1' => $number1 ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Number Could Not Be Updated...");
			}
	}



//Function to Update Alternate Email
    public function updateAltEmail($user, $email1){
	  $query = "UPDATE profile SET `email1` = :email1 WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':email1', $email1);
	  $user = $sql->execute([ ':uniqueid' => $user, ':email1' => $email1 ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Alternate Email Could Not Be Updated...");
			}
	}




//Function to Update 2FA Settings 
    public function update2faAlert($user){

    	$query = "SELECT * FROM users WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);

	  if ($data['notify'] == "On"){

	  $query = "UPDATE users SET `notify` = :notify WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':notify', $notify);
	  $data = $sql->execute([ ':uniqueid' => $user, ':notify' => "Off" ]);
	}
	if ($data['notify'] == "Off"){
	  $query = "UPDATE users SET `notify` = :notify WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql1 = $this->con->prepare($query);
	  $sql1->bindParam(':uniqueid', $user);
	  $sql1->bindParam(':notify', $notify);
	  $data = $sql1->execute([ ':uniqueid' => $user, ':notify' => "On" ]);
		}
	}

//Function to Get User Details
public function getAccDetails($uniqueid)
{
	$query = "SELECT fname, lname FROM users WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->execute();
		  $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

	  return $userinfo;
}

//Function to Add Transaction Details
public function insertTrancDetails($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $recaccbank, $pin, $bal, $recaccname)
{
	$data =	$this->confirmToken($user, $pin, $amount, $sendacc);
  	$data = $this->insertTransaction($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $recaccbank, $pin, $bal);
  	if ($recaccbank == "South BendLathe" && $tranctype == "Withdrawal") {
  		$data = $this->updateIntraPayBal($cardnum, $amount, $recaccname);
  		$data = $this->updateIntraPayStatus($trancid, $cardnum);
  	}
}

//Function to Update Alternate Email
    public function updateSecurity($user, $secq1, $seca1, $secq2, $seca2){
    	$query = "SELECT * FROM security WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  if ($RowCount == 1){

	  $query = "UPDATE security SET `secq1` = :secq1, `seca1` = :seca1, `secq2` = :secq2, `seca2` = :seca2  WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':secq1', $secq1);
	  $sql->bindParam(':seca1', $seca1);
	  $sql->bindParam(':secq2', $secq2);
	  $sql->bindParam(':seca2', $seca2);
	  $user = $sql->execute([ ':uniqueid' => $user, ':secq1' => $secq1, ':seca1' => $seca1, ':secq2' => $secq2, ':seca2' => $seca2 ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Security Questions Could Not Be Updated...");
			}
	}else{
		$query = "INSERT INTO security
	        (uniqueid, secq1, seca1, secq2, seca2) VALUES 
	        (:uniqueid, :secq1, :seca1, :secq2, :seca2)";
	          $stmt = $this->con->prepare($query);
	          $stmt->bindParam(':uniqueid', $user);
			  $stmt->bindParam(':secq1', $secq1);
			  $stmt->bindParam(':seca1', $seca1);
			  $stmt->bindParam(':secq2', $secq2);
			  $stmt->bindParam(':seca2', $seca2);
	          $stmt->execute();
	}

}




//Function to Update Address
    public function updateAdd($user, $address, $city, $zipcode, $country){
	  $query = "UPDATE profile SET `address` = :address, `city` = :city, `zipcode` = :zipcode, `country` = :country WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':address', $address);
	  $sql->bindParam(':city', $city);
	  $sql->bindParam(':zipcode', $zipcode);
	  $sql->bindParam(':country', $country);
	  $user = $sql->execute([ ':uniqueid' => $user, ':address' => $address, ':city' => $city, ':zipcode' => $zipcode, ':country' => $country ]);
	  // Checking all User credentials...
	        if ($user == false) {
	        	throw new Exception("Address Could Not Be Updated...");
			}
	}







//Function to Top Up Card
	 public function cardTopup($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $cvv, $pin, $expmonth, $recaccbank, $expyear, $ip, $user_agent, $bal){

    	$query = "SELECT * FROM transaction WHERE trancid = :trancid AND uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->bindParam(':trancid', $trancid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  	if ($trancid == $data['trancid'] && $data['status'] == 'Processing'){
	  		throw new Exception("This Transaction Is Currently Been Processed, What a While...");	
		  	}else{
		  	$data =	$this->confirmToken($user, $pin, $amount, $sendacc);
		  	$data = $this->insertCardDetails($user, $sendacc, $receiver, $cardnum, $amount, $cvv, $expmonth, $expyear, $ip, $user_agent);
		  	$data = $this->insertTransaction($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $recaccbank, $pin, $bal);
		  	}
	}

private function insertCardDetails($user, $sendacc, $receiver, $cardnum, $amount, $cvv, $expmonth, $expyear, $ip, $user_agent){

		$query = "INSERT INTO cardinfo
		        (uniqueid, sender, receiver, cardnum, cvv, expmonth, expyear, ip, user_agent) VALUES 
		        (:uniqueid, :sender, :receiver, :cardnum, :cvv, :expmonth, :expyear, :ip, :user_agent)";
			          $stmt1 = $this->con->prepare($query);
			          $stmt1->bindParam(':uniqueid', $user);
					  $stmt1->bindParam(':sender', $sendacc);
					  $stmt1->bindParam(':receiver', $receiver);
					  $stmt1->bindParam(':cardnum', $cardnum);
					  $stmt1->bindParam(':cvv', $cvv);
					  $stmt1->bindParam(':expmonth', $expmonth);
					  $stmt1->bindParam(':expyear', $expyear);
					  $stmt1->bindParam(':ip', $ip);
					  $stmt1->bindParam(':user_agent', $user_agent);
			          $data1 = $stmt1->execute();
	}

private function insertTransaction($user, $sendacc, $trancid, $receiver, $cardnum, $amount, $tranctype, $recaccbank, $pin, $bal){
		$query = "SELECT * FROM transaction WHERE trancid = :trancid AND uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->bindParam(':trancid', $trancid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  	if ($trancid == $data['trancid'] && $data['status'] == 'Processing'){
	  		throw new Exception("This Transaction Is Currently Been Processed, What a While...");	
		  	}else{
		  		$query = "INSERT INTO transaction
	        (uniqueid, trancid, recaccname, recaccnum, recaccbank, sendacc, tranctype, amount, bal) VALUES 
	        (:uniqueid, :trancid, :recaccname, :recaccnum, :recaccbank, :sendacc, :tranctype, :amount, :bal)";
	          $stmt2 = $this->con->prepare($query);
	          $stmt2->bindParam(':uniqueid', $user);
	          $stmt2->bindParam(':trancid', $trancid);
			  $stmt2->bindParam(':sendacc', $sendacc);
			  $stmt2->bindParam(':recaccname', $receiver);
			  $stmt2->bindParam(':recaccnum', $cardnum);
			  $stmt2->bindParam(':recaccbank', $recaccbank);
			  $stmt2->bindParam(':amount', $amount);
			  $stmt2->bindParam(':bal', $bal);
			  $stmt2->bindParam(':tranctype', $tranctype);
	          $data2 = $stmt2->execute();

	      }
      }

//Confirm User Account Token
private function confirmToken($user, $pin, $amount, $sendacc){
		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid AND pin = :pin LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->bindParam(':pin', $pin);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  	if ($pin != $data['pin']){
	  		throw new Exception("This Pin/Token Is Incorrect, Try Again...");	
		  	}elseif($sendacc == $data['accnum1']){

		  		if ($amount < $data['accnum1bal']) {
		  			$accBal = $data['accnum1bal'] - $amount;
		  			$spendbla = $data['accnum2bal'] + $accBal;
		  			$this->updateBal($user, $sendacc, $accBal, $spendbla);
		  		}else{
		  			throw new Exception("Your Account Balance Is Low...");
		  		}
		  		
		  	}elseif ($sendacc == $data['accnum2']){

		  		if ($amount < $data['accnum2bal']) {
		  			$accBal = $data['accnum2bal'] - $amount;
		  			$spendbla = $data['accnum1bal'] + $accBal;
		  			$this->updateBal($user, $sendacc, $accBal, $spendbla);
		  		}else{
		  			throw new Exception("Your Account Balance Is Low...");
		  		}
		  	}
      }
  

 private function updateBal($user, $sendacc, $accBal, $spendbla)
	{
		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  	if ($sendacc == $data['accnum1']){
	  		$query = "UPDATE accdetails SET `availbalance` = :availbalance, `accnum1bal` = :accnum1bal WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':availbalance', $spendbla);
	  $sql->bindParam(':accnum1bal', $accBal);
	  $user = $sql->execute([ ':uniqueid' => $user, ':availbalance' => $spendbla, ':accnum1bal' => $accBal ]);
	  	}elseif ($sendacc == $data['accnum2']){
	  		$query = "UPDATE accdetails SET `availbalance` = :availbalance, `accnum2bal` = :accnum2bal WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':availbalance', $spendbla);
	  $sql->bindParam(':accnum2bal', $accBal);
	  $user = $sql->execute([ ':uniqueid' => $user, ':availbalance' => $spendbla, ':accnum2bal' => $accBal ]);
	  	}

	
}



//Update IntraPay Receiver Account
 private function updateIntraPayBal($cardnum, $amount, $recaccname)
	{
		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $recaccname);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);

	  	if ($cardnum == $data['accnum1']){

	  		$newbal = $data['accnum1bal'] + $amount;
	  		$newavailbal = $data['availbalance'] + $amount;

	  		$query = "UPDATE accdetails SET `availbalance` = :availbalance, `accnum1bal` = :accnum1bal WHERE uniqueid = :uniqueid LIMIT 1";
			  $sql = $this->con->prepare($query);
			  $sql->bindParam(':uniqueid', $recaccname);
			  $sql->bindParam(':availbalance', $newavailbal);
			  $sql->bindParam(':accnum1bal', $newbal);
			  $sql->execute([ ':uniqueid' => $recaccname, ':availbalance' => $newavailbal, ':accnum1bal' => $newbal ]);
	}elseif ($cardnum == $data['accnum2']){

	  		$newbal = $data['accnum2bal'] + $amount;
	  		$newavailbal = $data['availbalance'] + $amount;

	  		$query = "UPDATE accdetails SET `availbalance` = :availbalance, `accnum2bal` = :accnum2bal WHERE uniqueid = :uniqueid LIMIT 1";
			  $sql = $this->con->prepare($query);
			  $sql->bindParam(':uniqueid', $recaccname);
			  $sql->bindParam(':availbalance', $newavailbal);
			  $sql->bindParam(':accnum2bal', $newbal);
			  $sql->execute([ ':uniqueid' => $recaccname, ':availbalance' => $newavailbal, ':accnum2bal' => $newbal ]);
	}
}

//Update IntraPay Transaction Status
 private function updateIntraPayStatus($trancid, $cardnum)
	{

		$query = "UPDATE transaction SET `status` = :status WHERE trancid = :trancid AND recaccnum = :recaccnum LIMIT 1";
			  $sql = $this->con->prepare($query);
			  $sql->bindParam(':trancid', $trancid);
			  $sql->bindParam(':recaccnum', $cardnum);

			  $sql->execute([ ':status' => "Completed", ':trancid' => $trancid, ':recaccnum' => $cardnum ]);
	}


















































































//Function to Delete Account
    public function deleteAcc($user, $password, $status, $login_status){
    	$query = "SELECT password FROM users WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $user);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  //$RowCount = $stmt->rowCount();

    	if (password_verify($password, $data['password'])) {
		  $query = "UPDATE users SET `status` = :status, `login_status` = :login_status WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $user);
		  $sql->bindParam(':status', $status);
		  $sql->bindParam(':login_status', $login_status);
		  $data1 = $sql->execute([ ':uniqueid' => $user, ':status' => $status, ':login_status' => $login_status ]);
	  // Checking all User credentials..
	  }else{
	  		throw new Exception("This Action Could Not Complete Successfully, Try Again Later...");
	  }
	}



//end of file

}
