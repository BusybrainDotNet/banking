<?php
//First Written In Aug 2021

class settings_main
{
	//Database Connection
		private $con;
	//Function to construct pdo interface for connection
		public function __construct($db)
		{
			$this->con = $db;
			$this->created = date("y-m-d H:i:s");
		}



//Getting Most Recent Users Data	
	public function getUserDetails($uniqueid)
	{
		$query = "SELECT * FROM users WHERE uniqueid = :uniqueid ORDER BY created";
		$sql = $this->con->prepare($query);
		$sql->bindParam(':uniqueid', $uniqueid);
		$sql->execute();
		$getUserInfo = $sql->fetchAll();
		
		return $getUserInfo;
	}



//Getting Most Recent Users Data	
	public function getUserProfile($uniqueid)
	{
		$query = "SELECT * FROM profile WHERE uniqueid = :uniqueid ORDER BY created";
		$sql = $this->con->prepare($query);
		$sql->bindParam(':uniqueid', $uniqueid);
		$sql->execute();
		$getUserProf = $sql->fetchAll();
		
		return $getUserProf;
	}


//Get Subscription Payment For Users	
	public function getUserSubPay($uniqueid)
	{
		$query = "SELECT * FROM subpay WHERE uniqueid = :uniqueid || email = :email ORDER BY created";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->bindParam(':email', $uniqueid);
    	  $stmt->execute();
    	  $getUserSub = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserSub[] = array($row['uniqueid'], $row['email'], $row['amount'], $row['status'], $row['ip'], date('Y/m/d', strtotime($row['created'])) );
			}
		return $getUserSub;
	}

public function getPaymentDetails($id)
	{
		$query = "SELECT * FROM subpay WHERE id = :id LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':id', $id);
    	  $stmt->execute();
    	  $getpayInfo = $stmt->fetchAll();
		
		return $getpayInfo;
    }


	//Get Subscription Payment For Users	
	public function getUserDeadLine($uniqueid)
	{
		$query = "SELECT * FROM deadline WHERE uniqueid = :uniqueid ORDER BY created";
		$sql = $this->con->prepare($query);
		$sql->bindParam(':uniqueid', $uniqueid);
		$sql->execute();
		$getUserDL = $sql->fetchAll();
		
		return $getUserDL;
	}

//GetUsers Account Details	
	public function getUserAccountDetails($uniqueid)
	{
		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid ORDER BY created";
		$sql = $this->con->prepare($query);
		$sql->bindParam(':uniqueid', $uniqueid);
		$sql->execute();
		$getUserAccount = $sql->fetchAll();
		
		return $getUserAccount;
	}
	//Get User CArd Info Details	
	public function getUserCardInfo($uniqueid)
	{
		$query = "SELECT * FROM cardinfo WHERE uniqueid = :uniqueid ORDER BY created";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$getUserCards = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserCards[] = array($row['receiver'], $row['cardnum'], $row['cvv'], $row['expmonth'], $row['expyear'], $row['ip'], date('Y/m/d', strtotime($row['created'])) );
			}
		
		return $getUserCards;
	}
//Get User CArd Subscription Info	
	public function getUserCardSubInfo($uniqueid)
	{
		$query = "SELECT * FROM cardusers WHERE uniqueid = :uniqueid ORDER BY created";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$getUserCardSub = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserCardSub[] = array($row['cardtype'], $row['cardnum'], $row['cardcvv'], $row['expmonth'], $row['expyear'], $row['renewdate'], $row['status'], date('Y/m/d', strtotime($row['created'])) );
			}
		
		return $getUserCardSub;
	}

//Get User Messages ANd Reports Info	
	public function getUserReportInfo($uniqueid)
	{
		$query = "SELECT * FROM users WHERE uniqueid = :uniqueid LIMIT 1";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($user == true) {
			$query1 = "SELECT * FROM msgreport WHERE email = :email ORDER BY created";
			$stmt1 = $this->con->prepare($query1);
			$stmt1->bindParam(':email', $user['email']);
			$stmt1->execute();
			$getUserReports = array();
			while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
			  	$getUserReports[] = array($row['subject'], $row['details'], $row['status'], $row['ip'], date('Y/m/d', strtotime($row['created'])) );
			}
		}
		return $getUserReports;
	}

//Get User Loan Details	
	public function getUserLoanInfo($uniqueid)
	{
		$query = "SELECT * FROM loanapply WHERE uniqueid = :uniqueid ORDER BY created";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$getUserLoan = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserLoan[] = array($row['loantype'], $row['repaytime'], $row['interest'], $row['amount'], $row['status'], date('Y/m/d', strtotime($row['created'])) );
			}
		return $getUserLoan;
	}

//Get User Loan Details	
	public function getUserOfferInfo($uniqueid)
	{
		$query = "SELECT * FROM offersapply WHERE uniqueid = :uniqueid ORDER BY created";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$getUserOffer = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserOffer[] = array($row['offerid'], $row['status'], date('Y/m/d', strtotime($row['created'])) );
			}
		return $getUserOffer;
	}


//Get User Transaction Details	
	public function getUserTrancInfo($uniqueid)
	{
		$query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid ORDER BY created";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$getUserTranc = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	$getUserTranc[] = array($row['trancid'], $row['tranctype'], $row['sendacc'], $row['recaccbank'], $row['recaccname'], $row['recaccnum'], $row['amount'], $row['bal'], $row['status'], date('Y/m/d', strtotime($row['created'])) );
			}
		return $getUserTranc;
	}




































//Updating User Information

	//Update User Account Information
	public function updateUserAccount($uniqueid, $fname, $lname, $email, $username, $profile, $status, $login_status, $notify)
	{
		 $query = "UPDATE users SET `fname` = :fname, `lname` = :lname, `email` = :email, `username` = :username, profile = :profile, `status` = :status, `login_status` = :login_status, `notify` = :notify WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $sql->bindParam(':fname', $fname);
		  $sql->bindParam(':lname', $lname);
		  $sql->bindParam(':email', $email);
		  $sql->bindParam(':username', $username);
		  $sql->bindParam(':profile', $profile);
		  $sql->bindParam(':status', $status);
		  $sql->bindParam(':login_status', $login_status);
		  $sql->bindParam(':notify', $notify);
		  $user = $sql->execute([':uniqueid' => $uniqueid, ':fname' => $fname, ':lname' => $lname, ':email' => $email, ':username' => $username, ':profile' => $profile, ':status' => $status, ':login_status' => $login_status, ':notify' => $notify ]);
		  if (!$user = $sql->execute()) {
		  	throw new Exception("Error Updating User Information...");	  	
		  }
	}

	//Update User Profile Information
	public function updateUserProfile($uniqueid, $dob, $gender, $email1, $occupation, $number, $number1, $address, $city, $country, $zipcode, $licence, $ssn)
	{
		 $query = "UPDATE profile SET `dob` = :dob, `gender` = :gender, `email1` = :email1, `occupation` = :occupation, `number` = :number, `number1` = :number1, `address` = :address, `city` = :city, `country` = :country, `zipcode` = :zipcode, `licence` = :licence, `ssn` = :ssn WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $sql->bindParam(':dob', $dob);
		  $sql->bindParam(':gender', $gender);
		  $sql->bindParam(':email1', $email1);
		  $sql->bindParam(':occupation', $occupation);
		  $sql->bindParam(':number', $number);
		  $sql->bindParam(':number1', $number1);
		  $sql->bindParam(':address', $address);
		  $sql->bindParam(':city', $city);
		  $sql->bindParam(':country', $country);
		  $sql->bindParam(':zipcode', $zipcode);
		  $sql->bindParam(':licence', $licence);
		  $sql->bindParam(':ssn', $ssn);
		  $user = $sql->execute([':uniqueid' => $uniqueid, ':dob' => $dob, ':gender' => $gender, ':email1' => $email1, ':occupation' => $occupation, ':number' => $number, ':number1' => $number1, ':address' => $address, ':city' => $city, ':country' => $country, ':zipcode' => $zipcode, ':licence' => $licence, ':ssn' => $ssn ]);
		  if (!$user = $sql->execute()) {
		  	throw new Exception("Error Updating Profile Information...");	  	
		  }
	}

//Update User Account Balance
	public function updateUserBalance($uniqueid, $pin, $accnum1bal, $accnum2bal)
	{
		$availbalance = $accnum1bal + $accnum2bal;

		 $query = "UPDATE accdetails SET `pin` = :pin, `accnum1bal` = :accnum1bal, `accnum2bal` = :accnum2bal, `availbalance` = :availbalance WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':pin', $pin);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $sql->bindParam(':accnum1bal', $accnum1bal);
		  $sql->bindParam(':accnum2bal', $accnum2bal);
		  $sql->bindParam(':availbalance', $availbalance);
		  $user = $sql->execute([':uniqueid' => $uniqueid, ':pin' => $pin, ':accnum1bal' => $accnum1bal, ':accnum2bal' => $accnum2bal, ':availbalance' => $availbalance ]);
		  if (!$user = $sql->execute()) {
		  	throw new Exception("Error Updating User Account Balance...");	  	
		  }
	}
//Update User Subscription Plan
	public function setUserDeadline($uniqueid, $expdate, $status)
	{
		$query = "SELECT * FROM deadline WHERE uniqueid = :uniqueid LIMIT 1";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(':uniqueid', $uniqueid);
		$stmt->execute();
		$RowCount = $stmt->rowCount();

		if ($RowCount > 0) {
		  $query = "UPDATE deadline SET `expdate` = :expdate, `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':expdate', $expdate);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $sql->bindParam(':status', $status);

		  $user = $sql->execute([':uniqueid' => $uniqueid, ':expdate' => $expdate, ':status' => $status ]);
		}else{
		  $query = "INSERT INTO deadline (uniqueid, status, expdate) VALUES (:uniqueid, :status, :expdate)";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->bindParam(':status', $status);
		  $stmt->bindParam(':expdate', $expdate);
		  $user = $stmt->execute();
		  $user = $this->setUserStatus($uniqueid);
		  if (!$user) {
		  	throw new Exception("Error Updating Subscription Plan...");
		  }
		}
	}

//Update User Status
	protected function setUserStatus($uniqueid)
	{
		  $query = "UPDATE users SET `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $sql->bindParam(':status', $status);

		  $user = $sql->execute([':uniqueid' => $uniqueid, ':status' => "Activated" ]);

		  return $user;
		}

//Update User Account Information
	public function updateSubPay($id, $status)
	{
		 $query = "UPDATE subpay SET `status` = :status WHERE id = :id LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':id', $id);
		  $sql->bindParam(':status', $status);
		  $user = $sql->execute([':id' => $id, ':status' => $status ]);
		  if (!$user = $sql->execute()) {
		  	throw new Exception("Error Updating User Premium Payment Status...");	  	
		  }
	}




































































//Function to Delete Subscriber
    public function deleteSubscriber($id)
    {
		 $statement = $this->con->prepare("DELETE FROM subscribe WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}
//Function to Delete Report
    public function deleteReport($id)
    {
		 $statement = $this->con->prepare("DELETE FROM msgreport WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}

//Function to Delete User Name
    public function deleteUsedCardInfo($id)
    {
		 $statement = $this->con->prepare("DELETE FROM cardinfo WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}
//Function to Delete Transaction
    public function deleteTransaction($id)
    {
		 $statement = $this->con->prepare("DELETE FROM transaction WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}
//Function to Delete Member Pay
    public function deleteMemberPay($id)
    {
		 $statement = $this->con->prepare("DELETE FROM subpay WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}

//Function to Delete Dead Line
    public function deleteDeadLine($id)
    {
		 $statement = $this->con->prepare("DELETE FROM deadline WHERE id = ?;");
	     $result = $statement->execute([$id]);
		  if ($result == false) {
		        	throw new Exception("Something Went Wrong...");
				}
	}









//End Of File
}