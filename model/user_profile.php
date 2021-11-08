<?php

class user_profile
{
	//Declaring variables
		private $id;
		private $uniqueid;
		private $gender;
		private $number;
		private $number1;
		private $email1;
		private $nationality;
		private $address;
		private $city;
		private $country;
		private $zipcode;
		private $licence;
		private $ssn;
		private $profileimage;
		private $occupation;
		private $dob;
		private $idfront;
		private $idback;
		private $desc;
		private $created;

	//Database Connection
		private $con;
		private $db_table = "profile";
	//Function to construct pdo interface for connection
		public function __construct($db)
		{
			$this->con = $db;
			$this->created = date("y-m-d H:i:s");
		}
	//ID 
		function setId($id)
		{
			$this->id = $id;
		}

		function getId()
		{
			return $this->id;
		}

	//User uniqueid
		function setuniqueid($uniqueid)
		{
			$this->uniqueid = $uniqueid;
		}

		function getuniqueid()
		{
			return $this->uniqueid;
		}

	//User gender
		function setGender($gender)
		{
			$this->gender = $gender;
		}

		function getGender()
		{
			return $this->code;
		}

	//User nationality
		function setNationality($nationality)
		{
			$this->nationality = $nationality;
		}

		function getNationality()
		{
			return $this->nationality;
		}
	//User address
		function setAddress($address)
		{
			$this->address = $address;
		}

		function getAddress()
		{
			return $this->address;
		}

	//User city
		function setCity($city)
		{
			$this->city = $city;
		}

		function getCity()
		{
			return $this->city;
		}

	//User country
		function setCountry($country)
		{
			$this->country = $country;
		}

		function getCountry()
		{
			return $this->country;
		}

	//User Zipcode
		function setZipcode($zipcode)
		{
			$this->zipcode = $zipcode;
		}

		function getZipcode()
		{
			return $this->zipcode;
		}

	//User licence
		function setLicence($licence)
		{
			$this->licence = $licence;
		}

		function getLicence()
		{
			return $this->licence;
		}

	//User SSN
		function setSsn($ssn)
		{
			$this->ssn = $ssn;
		}

		function getSsn()
		{
			return $this->ssn;
		}


//User Profileimage
		function setProfileimage($profileimage)
		{
			$this->profileimage = $profileimage;
		}

		function getProfileimage()
		{
			return $this->profileimage;
		}

//User Occupation
		function setOccupation($occupation)
		{
			$this->occupation = $occupation;
		}

		function getOccupation()
		{
			return $this->occupation;
		}

//User Dob
		function setDob($dob)
		{
			$this->dob = $dob;
		}

		function getDob()
		{
			return $this->dob;
		}

//User Idfront
		function setIdfront($idfront)
		{
			$this->idfront = $idfront;
		}

		function getIdfront()
		{
			return $this->idfront;
		}

//User Idback
		function setIdback($idback)
		{
			$this->idback = $idback;
		}

		function getIdback()
		{
			return $this->idback;
		}

//User desc
		function setdesc($desc)
		{
			$this->desc = $desc;
		}

		function getdesc()
		{
			return $this->desc;
		}


	//Time User Was Created
		function setcreated($created)
		{
			$this->created = $created;
		}

		function getcreated()
		{
			return $this->created;
		}



//Checking User Profile
	public function userProfile($user)
		{
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        $_SESSION['email1']  = $user['email1'];
	      	$_SESSION['gender'] = $user['gender'];
	      	$_SESSION['number'] = $user['number'];
	      	$_SESSION['number1'] = $user['number1'];
	      	$_SESSION['address'] = $user['address'];
	      	$_SESSION['city'] = $user['city'];
	      	$_SESSION['zipcode'] = $user['zipcode'];
	      	$_SESSION['country'] = $user['country'];
	      	$_SESSION['ssn'] = $user['ssn'];
	      	$_SESSION['licence'] = $user['licence'];
	      	$_SESSION['idfront'] = $user['idfront'];
	      	$_SESSION['idback'] = $user['idback'];
	      	$_SESSION['dob'] = $user['dob'];
	      	$_SESSION['desc'] = $user['desc'];
	      	$_SESSION['profileimage'] = $user['profileimage'];
	      	$_SESSION['created'] = $user['created'];

	      	if ($user['profileimage'] == "favicon.png") {
	      		throw new Exception("Change Account Photo");
			}
			if ($user['number'] == NULL || $user['ssn'] == NULL || $user['licence'] == NULL) {
	      		throw new Exception("Update Personal Information");
			}
			if ($user['address'] == NULL || $user['city'] == NULL) {
	      		throw new Exception("Update Home Address");
			}
			if ($user['idfront'] == NULL || $user['idback'] == NULL) {
	      		throw new Exception("Verify Account Information");
			}
			if ($user['occupation'] == NULL) {
	      		throw new Exception("Tell Us What You Do");
			}
			if ($user['desc'] == NULL) {
	      		throw new Exception("Tell Us About Yourself");
			}
	}




//Checking User Account Details
	public function userAccount($user)
		{
        $query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':uniqueid', $user);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

//Reconstructing User Output Details
        $user['accnum1norm'] = $user['accnum1'];
        $user['accnum2norm'] = $user['accnum2'];
		$user['availbalance'] = number_format($user['availbalance']);
		$user['accnum1bal'] = number_format($user['accnum1bal']);
		$user['accnum2bal'] = number_format($user['accnum2bal']);
		$user['accnum1'] = substr($user['accnum1'], 10);
        $user['accnum2'] = substr($user['accnum2'], 10);

// Checking all User credentials...
        $_SESSION['availbalance']  = $user['availbalance'];
        $_SESSION['acctype']  = $user['acctype'];
        $_SESSION['accnum1']  = $user['accnum1'];
        $_SESSION['accnum2']  = $user['accnum2'];
        $_SESSION['accnum1norm']  = $user['accnum1norm'];
        $_SESSION['accnum2norm']  = $user['accnum2norm'];
        $_SESSION['pin']  = $user['pin'];
        $_SESSION['accnum1bal']  = $user['accnum1bal'];
        $_SESSION['accnum2bal']  = $user['accnum2bal'];

        if ($user['uniqueid'] == false) {
      		throw new Exception("User Account Credentials Not Found <br>Contact Support To Recitify This Challenge.");
		}
		if ($user['accnum1bal'] <= '1000') {
      		throw new Exception("You Need To Work On Your Finance To Qualify For Promotional Rewards.");
		}
	}





//Checking User Security Settings
	public function user2faSecurity($user)
	{
        $query = "SELECT notify FROM users WHERE uniqueid = :uniqueid LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':uniqueid', $user);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['notify'] == "Off") {
      		throw new Exception("Set Your Login Alerts For Account Safety... Go To Settings, Click 2FA Auth");
		}
	}




//Checking User Security Settings
	public function userSubAlert($user)
	{
        $query = "SELECT status FROM users WHERE uniqueid = :uniqueid LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':uniqueid', $user);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['status'] == "New") {
      		throw new Exception("Pay Up Your Membership Dues, Your Trial Period Will Soon Be Over <br>To Make Payment, Go To Settings, Click On Membership Status.");
		}
	}




//Checking User Security Settings
	public function userSecurity($user)
	{
	    $query = "SELECT * FROM security WHERE uniqueid = :uniqueid LIMIT 1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':uniqueid', $user);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
        $_SESSION['secq1']  = $user['secq1'];
        $_SESSION['seca1']  = $user['seca1'];
        $_SESSION['secq2']  = $user['secq2'];
        $_SESSION['seca2']  = $user['seca2'];

        if ($user['uniqueid'] == false) {
      		throw new Exception("Don't Loose Access To Your Account, Set Your Security Questions Now... Go To Settings, Click Security");
		}
		if ($user['seca2'] == NULL) {
      		throw new Exception("You Set Just One Security Q&A, Set One More Security Question... Go To Settings, Click Security");
		}
	}




//Free Trial Period For New User
public function trialPeriod($user)
	{
// Fetch and verify if the record is new...
    $query = "SELECT * FROM users WHERE uniqueid = :uniqueid LIMIT 1";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':uniqueid', $user);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['created']  = $data['created'];

    if ($data['status'] == 'New' && $data['profile'] != 'Admin'){
    // getting current date 
	   $curDate = date('Y/m/d');
	//Extract Date Only From Timestamp
    	$join = date('Y/m/d', strtotime($data['created']));
	//Add Seven Days Grace Period 
	   $Date1 = date('Y/m/d', strtotime($join. ' + 1 days'));
	   $Date2 = date('Y/m/d', strtotime($Date1. ' + 2 days'));
	   $Date3 = date('Y/m/d', strtotime($Date2. ' + 3 days'));
	   $Date4 = date('Y/m/d', strtotime($Date3. ' + 4 days'));
	   $graceDate = date('Y/m/d', strtotime($join. ' + 7 days'));

	   if ($curDate < $Date2){
	   		throw new Exception("Membership Period Is Less Than Six Days To Go <br>To Make Payment, Go To Settings, Click On Membership Status.<br> Pay Now To Avoid Deactivation...");
	   }
	   if ($curDate < $Date3){
	   		throw new Exception("Membership Period Is Less Than Four Days To Go <br>To Make Payment, Go To Settings, Click On Membership Status.<br> Pay Now To Avoid Your Account Deactivated...");
	   }
	   if ($curDate < $Date4){
	   		throw new Exception("Membership Period Is Just Few Hours To End <br>To Make Payment, Go To Settings, Click On Membership Status.<br> Pay Now To Avoid Your Account Deactivated...");
	   }
	   if ($curDate >= $graceDate && $data['profile'] != 'Admin'){

	   	// Fetch and verify if the record already exists...
      $query = "UPDATE users SET `login_status` = :login_status, `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);

	  $sql->bindParam(':status', $status);	  
	  $sql->bindParam(':uniqueid', $data['uniqueid']);
	  $sql->bindParam(':login_status', $login_status);

	  $data1 = $sql->execute([':uniqueid' => $data['uniqueid'], ':status' => "Deactivated", ':login_status' => "Logged_out" ]);

	  echo '<meta http-equiv="refresh" content="3; URL=../Member-Area/membership-fork.php?ref=Back-Home">';
	   }
	}
// Function to Check And Validate Subscribed Users
	elseif ($data['status'] == 'Activated' && $data['profile'] != 'Admin') {
		// Fetch and verify if the record is activated...
    $query = "SELECT * FROM deadline WHERE uniqueid = :uniqueid LIMIT 1";
    $stmt1 = $this->con->prepare($query);
    $stmt1->bindParam(':uniqueid', $user);
    $stmt1->execute();
    $RowCount1 = $stmt1->rowCount();
    $dat = $stmt1->fetch(PDO::FETCH_ASSOC);

    $_SESSION['uniqueid']  = $dat['uniqueid'];
    $_SESSION['created']  = $dat['created'];
    $_SESSION['expdate']  = $dat['expdate'];
// getting current date 
    $currentDate = date('Y/m/d');
//Extract Date Only From Timestamp
	$exp = date('Y/m/d', strtotime($dat['expdate']));
//Add Seven Days Grace Period 
   $ExpDate1 = date('Y/m/d', strtotime($exp. ' - 7 days'));
   $ExpDate2 = date('Y/m/d', strtotime($ExpDate1. ' + 3 days'));
   $gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

    if ($RowCount1 == 0){
	   	throw new Exception("Your Subscription Information Is Missing. <br>Contact Support If You Need Help.<br> Or Navigate To Payment Area...");
	   }
	if ($currentDate >= $ExpDate1){
	   	throw new Exception("Do You Know Your Subscription Is Expiring In Few days? <br>To Make Payment, Go To Settings, Click On Membership Status.<br> Pay Now To Avoid Deactivation...");
	   }
   if ($currentDate >= $ExpDate2){
	   	throw new Exception("You Have Only Few Hours To Renew Your Subscription <br>To Make Payment, Go To Settings, Click On Membership Status.<br> Pay Now To Avoid Deactivation...");
	   }
	if ($currentDate >= $gDate){
// Fetch and verify if the record already exists...
      $query = "UPDATE users SET `login_status` = :login_status, `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);

	  $sql->bindParam(':status', $status);	  
	  $sql->bindParam(':uniqueid', $dat['uniqueid']);
	  $sql->bindParam(':login_status', $login_status);
	  $sql->execute([':uniqueid' => $dat['uniqueid'], ':status' => "Deactivated", ':login_status' => "Logged_out" ]);
	  echo '<meta http-equiv="refresh" content="3; URL=../Member-Area/membership-fork.php?ref=Back-Home">';
	   }

	}
}




//Function to Check Card Application Status 
    public function cardApply($uniqueid){
    	$query = "SELECT * FROM cardusers WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);

		  	$_SESSION['cardtype'] = $data['cardtype'];
	  		$_SESSION['cardnum'] = $data['cardnum'];
	  		$_SESSION['cardcvv'] = $data['cardcvv'];
	  		$_SESSION['expyear'] = $data['expyear'];
	  		$_SESSION['expmonth'] = $data['expmonth'];
	  		$_SESSION['renewdate'] = $data['renewdate'];
	  		$_SESSION['status'] = $data['status'];

	  if ($data['uniqueid'] == false){
	  	throw new Exception("You Are Yet To Apply For A Card");
		}elseif (($data['uniqueid'] == true) && ($data['status'] == "Processing")){
	  	throw new Exception("Your Application Is In Process, You Will Get An Update Soon");
		}elseif (($data['uniqueid'] == true) && ($data['status'] == "Pending")){
	  	throw new Exception("Your Application Is Pending, Contact Support");
		}elseif (($data['uniqueid'] == true) && ($data['status'] == "Cancelled")){
	  	throw new Exception("Your Application Is Cancelled, Contact Support");
		}elseif (($data['uniqueid'] == true) && ($data['status'] == "Blocked")){
	  	throw new Exception("Your Card Has Been Blocked, Apply For A New Card");
		}
	}




//Function to Check Promotional Offer 
    public function offers(){
    	$query = "SELECT * FROM offers";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  if ($RowCount < 1){
	  	throw new Exception("There Is Currently No Promotional Offer(s)");
		}
	}



//Function to Check Users Reward Offer 
    public function offersApply($uniqueid){
    	$query = "SELECT * FROM offersapply WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

	  if ($data['uniqueid'] == false){
	  	throw new Exception("You Are Currently Not Enrolled In Any Offer(s)");
		}
	}




//Function to Check Membership Status
    public function memberStatus($uniqueid){
    	$query = "SELECT * FROM deadline WHERE uniqueid = :uniqueid LIMIT 1";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();

		  $_SESSION['memberexpdate'] = $data['expdate'];
		  $_SESSION['memberstatus'] = $data['status'];

	  if ($data['uniqueid'] == false){
	  	throw new Exception("You Are Currently Not Enrolled As A premium User");
		}
	}




//Function to Check User Transactions
    public function userTransactions($uniqueid){
      $query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));
			$xDate = date('Y/m/d', strtotime($exp. ' + 30 days'));
		  /*$_SESSION['created'] = $data['created'];
		  $_SESSION['memberstatus'] = $data['status'];*/

	  if ($data['uniqueid'] == false){
	  	throw new Exception("You Currently Have No Transaction(s).");
		}elseif ($currentDate >= $gDate){
	  	throw new Exception("You Have No Recent Transaction(s).");
		}elseif ($currentDate >= $xDate){
	  	throw new Exception("You Need To Make a Transaction(s).");
		}
	}




//Function to Check User Primary Account Transactions
    public function userPrimaryTransactions($uniqueid){
    		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid";
			  $stmt1 = $this->con->prepare($query);
			  $stmt1->bindParam(':uniqueid', $uniqueid);
			  $stmt1->execute();
			  $data1 = $stmt1->fetch(PDO::FETCH_ASSOC);

		if ($data1 == true){
				$query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid AND sendacc = :sendacc";
				  $stmt = $this->con->prepare($query);
				  $stmt->bindParam(':uniqueid', $uniqueid);
				  $stmt->bindParam(':sendacc', $data1['accnum1']);
				  $stmt->execute();
				  $data = $stmt->fetch(PDO::FETCH_ASSOC);

		  	if ($data['sendacc'] == false) {

		  		throw new Exception("No Transaction(s) Found On Primary.");
	  		}
		}	
	}



//Function to Check User Primary Account Transactions
    public function userHeritageTransactions($uniqueid){
    		$query = "SELECT * FROM accdetails WHERE uniqueid = :uniqueid";
			  $stmt1 = $this->con->prepare($query);
			  $stmt1->bindParam(':uniqueid', $uniqueid);
			  $stmt1->execute();
			  $data1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			  
		if ($data1 == true){
				$query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid AND sendacc = :sendacc";
				  $stmt = $this->con->prepare($query);
				  $stmt->bindParam(':uniqueid', $uniqueid);
				  $stmt->bindParam(':sendacc', $data1['accnum2']);
				  $stmt->execute();
				  $data = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($data['sendacc'] == false) {

		  		throw new Exception("No Transaction(s) Found On Heritage.");
		  	}
		}	
	}


//Function To Fetch User Transaction History
 public function userTransactionHistory($uniqueid, $sendacc){
      $query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid AND sendacc = :sendacc ORDER BY created DESC LIMIT 15 ";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->bindParam(':sendacc', $sendacc);
    	  $stmt->execute();

    	  $trancData = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		  	$trancData[] = array($row['sendacc'], $row['recaccnum'], $row['recaccname'], $row['recaccbank'], $row['amount'], $row['bal'], $row['tranctype'], $row['status'], $row['desc'], date('Y/m/d', strtotime($row['created'])), $row['trancid'], $row['uniqueid']
			   	);
		  	
			}
		return $trancData;
	}




//Function To Fetch User Transaction History
 public function userTransactionCheck($uniqueid, $sendacc){
      $query = "SELECT * FROM transaction WHERE uniqueid = :uniqueid AND sendacc = :sendacc";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->bindParam(':sendacc', $sendacc);
    	  $stmt->execute();
    	  $row = $stmt->fetch(PDO::FETCH_ASSOC);	
		  if ($row == false) {
		  	throw new Exception("No Transaction Found, Make a Deposit Now!");
		  }
	}


































//end of file
}