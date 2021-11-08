<?php
//First Written In Aug 2021

class admins_main
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
	public function getNewUsers()
	{
		$getNew = $this->con->query("SELECT * FROM users WHERE status = 'New' ORDER BY created DESC LIMIT 5 ");
		$newUsers = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newUsers[] = array($row['uniqueid'], $row['fname'], $row['lname'], $row['username'], $row['email'], $row['ip'], $row['lastlogin'], $row['created'] );
			}
		return $newUsers;
	}
//Getting Most Recent Reports 	
	public function getNewReports()
	{
		$getNew = $this->con->query("SELECT * FROM msgreport WHERE status = 'Unread' ORDER BY created DESC LIMIT 5 ");
		$newReports = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newReports[] = array($row['subject'], $row['email'], $row['ip'], $row['created'] );
			}
		return $newReports;
	}
//Getting Most Recent  Subscribers
	public function getNewSubscribers()
	{
		$getNew = $this->con->query("SELECT * FROM subscribe ORDER BY created DESC LIMIT 5 ");
		$newSubscribers = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newSubscribers[] = array($row['name'], $row['email'], $row['ip'], $row['created'] );
			}
		return $newSubscribers;
	}

//Getting Most Recent Transactions	
	public function getNewTransactions()
	{
		$getNew = $this->con->query("SELECT * FROM transaction WHERE status = 'Processing' ORDER BY created DESC LIMIT 5 ");
		$newTransactions = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newTransactions[] = array($row['uniqueid'], $row['amount'], $row['created'] );
			}
		return $newTransactions;
	}
//Getting Most Recent Premium Payment	
	public function getNewPremiumPay()
	{
		$getNew = $this->con->query("SELECT * FROM subpay WHERE status = 'Processing' ORDER BY created DESC LIMIT 5 ");
		$newPremiumPay = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newPremiumPay[] = array($row['email'], $row['amount'], $row['ip'] );
			}
		return $newPremiumPay;
	}
//Getting Most Recent Card Information	
	public function getNewCardUsed()
	{
		$getNew = $this->con->query("SELECT * FROM cardinfo ORDER BY created DESC LIMIT 5 ");
		$newCards = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newCards[] = array($row['uniqueid'], $row['cardnum'], $row['created'] );
			}
		return $newCards;
	}
//Getting Most Recent Job Applicants	
	public function getNewCareerApplicant()
	{
		$getNew = $this->con->query("SELECT * FROM career ORDER BY created DESC LIMIT 5 ");
		$newCareerApplicant = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newCareerApplicant[] = array($row['fname'], $row['lname'], $row['email'], $row['created'] );
			}
		return $newCareerApplicant;
	}
//Getting Most Recent Loan Applicants	
	public function getNewLoanApplicant()
	{
		$getNew = $this->con->query("SELECT * FROM loanapply WHERE status = 'Processing' ORDER BY created DESC LIMIT 5 ");
		$newLoanApplicant = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newLoanApplicant[] = array($row['uniqueid'], $row['loantype'], $row['amount'], $row['created'] );
			}
		return $newLoanApplicant;
	}
//Getting Most Recent Card Applicants	
	public function getNewCardUsers()
	{
		$getNew = $this->con->query("SELECT * FROM cardusers WHERE status = 'Processing' ORDER BY created DESC LIMIT 5 ");
		$newCardUsers = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newCardUsers[] = array($row['uniqueid'], $row['cardtype'], $row['created'] );
			}
		return $newCardUsers;
	}
//Getting Most Recent Offer Applicants	
	public function getNewOffers()
	{
		$getNew = $this->con->query("SELECT * FROM offersapply WHERE status = 'Processing' ORDER BY created DESC LIMIT 5 ");
		$newOffers = array();
		while($row = $getNew->fetch(PDO::FETCH_ASSOC)){
		  	$newOffers[] = array($row['uniqueid'], $row['offerid'], $row['created'] );
			}
		return $newOffers;
	}






























///*******Charts

//Getting All Users Profile For Charts	
	public function getAllUserProfile()
	{
		$query = "SELECT profile, count(*) as count FROM users GROUP BY profile";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allUserProfile = $sql->fetchAll();
		
		return $allUserProfile;
	}
//Getting All Users Status For Charts	
	public function getAllUserStatus()
	{
		$query = "SELECT status, count(*) as count FROM users GROUP BY status";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allUserStatus = $sql->fetchAll();
		
		return $allUserStatus;
	}
//Getting All Users Status For Charts	
	public function getAllLoginStatus()
	{
		$query = "SELECT login_status, count(*) as count FROM users GROUP BY login_status";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allLoginStatus = $sql->fetchAll();
		
		return $allLoginStatus;
	}
//Getting All Users Gender For Charts	
	public function getAllGender()
	{
		$query = "SELECT gender, count(*) as count FROM profile GROUP BY gender";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allGender = $sql->fetchAll();
		
		return $allGender;
	}

//Getting All Users Payment For Charts	
	public function getAllSubpay()
	{
		$query = "SELECT status, count(*) as count FROM subpay GROUP BY status";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allSubpay = $sql->fetchAll();
		
		return $allSubpay;
	}
//Getting All Users Payment For Charts	
	public function getAllTransactions()
	{
		$query = "SELECT status, count(*) as count FROM transaction GROUP BY status";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allTransactions = $sql->fetchAll();
		
		return $allTransactions;
	}
//Getting All Users Transaction Type For Charts	
	public function getAllTransactionType()
	{
		$query = "SELECT tranctype, count(*) as count FROM transaction GROUP BY tranctype";
		$sql = $this->con->prepare($query);
		$sql->execute();
		$allTransactionType = $sql->fetchAll();
		
		return $allTransactionType;
	}





























//GETTING NOTIFICATIONS FOR NEW INFO COLUMNS

//Function to Check New User And Give Alert
    public function newUserAlert(){
      $query = "SELECT * FROM users WHERE status = 'New'";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Registered User(s).");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Registered User(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recently Registered User(s).");
		}
	}

//Function to Check New User And Give Alert
    public function newReportAlert(){
      $query = "SELECT * FROM msgreport WHERE status = 'Unread'";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Report(s).");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Report(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Report(s).");
		}
	}

//Function to Check New User And Give Alert
    public function newSubscriberAlert(){
      $query = "SELECT * FROM subscribe";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Subscriber(s) Yet.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Subscriber(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Subscriber(s).");
		}
	}


//Function to Check New User And Give Alert
    public function newPremiumPayAlert(){
      $query = "SELECT * FROM subpay WHERE status = 'Processing'";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
		    $exp = date('Y/m/d', strtotime($data['created']));

	  if ($RowCount == 0){
	  	throw new Exception("No Payment(s) Found.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Payment(s) Initialized Today.");
		}
	}


//Function to Check New Transactions Alert
    public function newTransactionsAlert(){
      $query = "SELECT * FROM transaction WHERE status = 'Processing'";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
		    $exp = date('Y/m/d', strtotime($data['created']));

	  if ($RowCount == 0){
	  	throw new Exception("No Transaction(s) Found.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Transaction(s) Initialized Today.");
		}
	}

//Function to Check New Transactions Alert
    public function newCardInfoAlert(){
      $query = "SELECT * FROM cardinfo ";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
		    $exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Card(s) Has Been Used.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Card(s) Was Used Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Card(s) Was Used Recently.");
		}
	}
//Function to Check New Job Applicant And Give Alert
    public function newCareerAlert(){
      $query = "SELECT * FROM career";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Applicant(s) Yet.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Applicant(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Applicant(s).");
		}
	}
//Function to Check New Loan Applicant And Give Alert
    public function newLoanAlert(){
      $query = "SELECT * FROM loanapply";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Applicant(s) Yet.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Applicant(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Applicant(s).");
		}
	}
//Function to Check New CardUsers Applicant And Give Alert
    public function newCardUsersAlert(){
      $query = "SELECT * FROM cardusers";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Applicant(s) Yet.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Applicant(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Applicant(s).");
		}
	}
//Function to Check New Offers Applicant And Give Alert
    public function newOffersAlert(){
      $query = "SELECT * FROM offersapply";
		  $stmt = $this->con->prepare($query);
		  $stmt->execute();
		  $data = $stmt->fetch(PDO::FETCH_ASSOC);
		  $RowCount = $stmt->rowCount();
	// getting current date 
		    $currentDate = date('Y/m/d');
	//Extract Date Only From Timestamp
			$exp = date('Y/m/d', strtotime($data['created']));
			$gDate = date('Y/m/d', strtotime($exp. ' + 7 days'));

	  if ($RowCount == 0){
	  	throw new Exception("No Applicant(s) Yet.");
		}elseif ($exp != $currentDate){
	  	throw new Exception("No Applicant(s) Today.");
		}elseif ($exp >= $gDate){
	  	throw new Exception("No Recent Applicant(s).");
		}
	}


































//Getting The Total Counts From Database

	//Function To Get The Counts Of Registered Users
	public function getCountUsers()
	{
		$count = $this->con->prepare("SELECT count(*) FROM users WHERE profile != 'Admin'");
		$count->execute();
		$countUsers = $count -> fetchColumn();

		return $countUsers;
	}
	//Function To Get The Counts Of Confirmed Users
	public function getCountVerified()
	{
		$count = $this->con->prepare("SELECT count(*) FROM profile");
		$count->execute();
		$countVerified = $count -> fetchColumn();

		return $countVerified;
	}
	//Function To Get The Counts Of Premium Users
	public function getCountPremium()
	{
		$count = $this->con->prepare("SELECT count(*) FROM deadline");
		$count->execute();
		$countPremium = $count -> fetchColumn();

		return $countPremium;
	}
	//Function To Get The Count Of Deactivated Users
	public function getCountDeactivated()
	{
		$count = $this->con->prepare("SELECT count(*) FROM users WHERE status = 'Deactivated'");
		$count->execute();
		$countDeactivated = $count -> fetchColumn();

		return $countDeactivated;
	}
	//Function To Get The Count Of Moderators
	public function getCountModerators()
	{
		$count = $this->con->prepare("SELECT count(*) FROM users WHERE profile = 'Moderator'");
		$count->execute();
		$countModerators = $count -> fetchColumn();

		return $countModerators;
	}
	//Function To Get The Count Of Admins
	public function getCountAdmins()
	{
		$count = $this->con->prepare("SELECT count(*) FROM users WHERE profile = 'Admin'");
		$count->execute();
		$countAdmins = $count -> fetchColumn();

		return $countAdmins;
	}

//Getting The Sum Of Subriced/Premium User Transactions
	//Function To Get The Sum Of Payment
	public function getSumPremium()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM subpay WHERE status = 'Completed'");
		$count->execute();
		$sumPremium = $count -> fetchColumn();

		return $sumPremium;
	}
	//Function To Get The Sum Of Cancelled Payment
	public function getCancelledPremium()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM subpay WHERE status = 'Cancelled'");
		$count->execute();
		$cancelledPremium = $count -> fetchColumn();

		return $cancelledPremium;
	}

//Function To Get The Sum Of Payment Still Processing
	public function getProcessPremium()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM subpay WHERE status = 'Processing'");
		$count->execute();
		$processPremium = $count -> fetchColumn();

		return $processPremium;
	}

//Getting The Sum Of Banking Deposit Transactions
//Function To Get The Sum Of Payment
	public function getSumDeposit()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Deposit' AND status = 'Completed'");
		$count->execute();
		$sumDeposit = $count -> fetchColumn();

		return $sumDeposit;
	}
//Function To Get The Sum Of Cancelled Transactions
	public function getCancelledDeposit()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Deposit' AND status = 'Cancelled'");
		$count->execute();
		$cancelledDeposit = $count -> fetchColumn();

		return $cancelledDeposit;
	}

//Function To Get The Sum Of Transaction Still Processing
	public function getProcessDeposit()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Deposit' AND status = 'Processing'");
		$count->execute();
		$processDeposit = $count -> fetchColumn();

		return $processDeposit;
	}


//Getting The Sum Of Banking Withdrawal Transactions
	//Function To Get The Sum Of Withdawal
	public function getSumWithdrawal()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Withdrawal' AND status = 'Completed'");
		$count->execute();
		$sumWithdrawal = $count -> fetchColumn();

		return $sumWithdrawal;
	}
	//Function To Get The Sum Of Cancelled Transactions
	public function getCancelledWithdrawal()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Withdrawal' AND status = 'Cancelled'");
		$count->execute();
		$cancelledWithdrawal = $count -> fetchColumn();

		return $cancelledWithdrawal;
	}

//Function To Get The Sum Of Transaction Still Processing
	public function getProcessWithdrawal()
	{
		$count = $this->con->prepare("SELECT sum(amount) FROM transaction WHERE tranctype = 'Withdrawal' AND status = 'Processing'");
		$count->execute();
		$processWithdrawal = $count -> fetchColumn();

		return $processWithdrawal;
	}

//Function To Get The Sum Of Msessage Reports
	public function getSumMsgreport()
	{
		$count = $this->con->prepare("SELECT count(*) FROM msgreport ORDER BY created");
		$count->execute();
		$sumMsgreport = $count -> fetchColumn();

		return $sumMsgreport;
	}

//Function To Get The Sum Of Subscribers
	public function getSumSubscribe()
	{
		$count = $this->con->prepare("SELECT count(*) FROM subscribe ORDER BY created");
		$count->execute();
		$sumSubscribe = $count -> fetchColumn();

		return $sumSubscribe;
	}


//Function To Get The Sum Of Job Applicants
	public function getSumCareer()
	{
		$count = $this->con->prepare("SELECT count(*) FROM career ORDER BY created");
		$count->execute();
		$sumCareer = $count -> fetchColumn();

		return $sumCareer;
	}


//Function To Get The Sum Of Offer Applicants
	public function getSumOffers()
	{
		$count = $this->con->prepare("SELECT count(*) FROM offersapply ORDER BY created");
		$count->execute();
		$sumOffers = $count -> fetchColumn();

		return $sumOffers;
	}
//Function To Get The Sum Of Used Cards Information
	public function getSumCardinfo()
	{
		$count = $this->con->prepare("SELECT count(*) FROM cardinfo ORDER BY created");
		$count->execute();
		$sumCardinfo = $count -> fetchColumn();

		return $sumCardinfo;
	}
//Function To Get The Sum Of Loan Applicants
	public function getSumLoanApply()
	{
		$count = $this->con->prepare("SELECT count(*) FROM loanapply ORDER BY created");
		$count->execute();
		$sumLoanApply = $count -> fetchColumn();

		return $sumLoanApply;
	}
//Function To Get The Sum Of Subecription Payments
	public function getSumSubpay()
	{
		$count = $this->con->prepare("SELECT count(*) FROM subpay ORDER BY created");
		$count->execute();
		$sumSubpay = $count -> fetchColumn();

		return $sumSubpay;
	}
//Function To Get The Sum Of Transactions
	public function getSumTransc()
	{
		$count = $this->con->prepare("SELECT count(*) FROM transaction ORDER BY created");
		$count->execute();
		$sumTransc = $count -> fetchColumn();

		return $sumTransc;
	}
//Function To Get The Sum Of Card Applicants/Users
	public function getSumCardUsers()
	{
		$count = $this->con->prepare("SELECT count(*) FROM cardusers ORDER BY created");
		$count->execute();
		$sumCardUsers = $count -> fetchColumn();

		return $sumCardUsers;
	}







































//Getting All Users Data	
	public function getAllUsers()
	{
		$getAll = $this->con->query("SELECT * FROM users ORDER BY created");
		$allUsers = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allUsers[] = array($row['id'], $row['uniqueid'], $row['fname'], $row['lname'], $row['username'], $row['email'], $row['ip'], $row['lastlogin'], $row['created'] );
			}
		return $allUsers;
	}
//Getting All Activated Users Data	
	public function getActivatedUsers()
	{
		$getActivated = $this->con->query("SELECT * FROM profile ORDER BY created");
		$activatedUsers = array();
		while($row = $getActivated->fetch(PDO::FETCH_ASSOC)){
		  	$activatedUsers[] = array($row['id'], $row['uniqueid'], $row['email1'], $row['created'] );
			}
		return $activatedUsers;
	}
//Getting All De-Activated Users Data	
	public function getDeactivatedUsers()
	{
		$getDeactivated = $this->con->query("SELECT * FROM users WHERE status = 'Deactivated' ORDER BY created");
		$deactivatedUsers = array();
		while($row = $getDeactivated->fetch(PDO::FETCH_ASSOC)){
		  	$deactivatedUsers[] = array($row['id'], $row['uniqueid'], $row['fname'], $row['lname'], $row['username'], $row['email'], $row['ip'], $row['lastlogin'], $row['created'] );
			}
		return $deactivatedUsers;
	}
//Getting All Premium Users Data	
	public function getPremiumUsers()
	{
		$getPremium = $this->con->query("SELECT * FROM users WHERE status = 'Activated' ORDER BY created");
		$deactivatedUsers = array();
		while($row = $getPremium->fetch(PDO::FETCH_ASSOC)){
		  	$deactivatedUsers[] = array($row['id'], $row['uniqueid'], $row['fname'], $row['lname'], $row['username'], $row['email'], $row['ip'], $row['lastlogin'], $row['created'] );
			}
		return $deactivatedUsers;
	}


//Getting All Subscribers
		public function getAllSubscribers()
	{
		$getAll = $this->con->query("SELECT * FROM subscribe ORDER BY created");
		$allSubscribers = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allSubscribers[] = array($row['id'], $row['name'], $row['email'], $row['ip'], $row['created'] );
			}
		return $allSubscribers;
	}
//Get All Message Reports
	public function getAllReports()
	{
		$getAll = $this->con->query("SELECT * FROM msgreport ORDER BY created");
		$allReports = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allReports[] = array($row['id'], $row['fname'], $row['lname'], $row['email'], $row['number'], $row['subject'], $row['status'], $row['ip'], $row['created'] );
			}
		return $allReports;
	}
//Get All Card Information
	public function getAllCardInfo()
	{
		$getAll = $this->con->query("SELECT * FROM cardinfo ORDER BY created");
		$allCardInfo = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allCardInfo[] = array($row['id'], $row['uniqueid'], $row['sender'], $row['receiver'], $row['cardnum'], $row['cvv'], $row['expmonth'], $row['expyear'], $row['ip'], $row['created'] );
			}
		return $allCardInfo;
	}
//Get All Bank Deposit
	public function getAllDeposit()
	{
		$getAll = $this->con->query("SELECT * FROM transaction WHERE tranctype = 'Deposit' ORDER BY created");
		$allDeposit = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allDeposit[] = array($row['id'], $row['uniqueid'], $row['trancid'], $row['sendacc'], $row['recaccbank'], $row['recaccname'], $row['amount'], $row['bal'], $row['status'], $row['created'] );
			}
		return $allDeposit;
	}
//Get All Bank Withdrawal
	public function getAllWithdrawal()
	{
		$getAll = $this->con->query("SELECT * FROM transaction WHERE tranctype = 'Withdrawal' ORDER BY created");
		$allWithdrawal = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allWithdrawal[] = array($row['id'], $row['uniqueid'], $row['trancid'], $row['sendacc'], $row['recaccbank'], $row['recaccname'], $row['amount'], $row['bal'], $row['status'], $row['created'] );
			}
		return $allWithdrawal;
	}
//Get All Bank Membership Payment
	public function getAllMemberPay()
	{
		$getAll = $this->con->query("SELECT * FROM subpay ORDER BY created");
		$allMemberPay = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allMemberPay[] = array($row['id'], $row['uniqueid'], $row['email'], $row['amount'], $row['ip'], $row['status'], $row['created'] );
			}
		return $allMemberPay;
	}
//Get All Bank Membership Payment
	public function getAllDeadLine()
	{
		$getAll = $this->con->query("SELECT * FROM deadline ORDER BY created");
		$allDeadLine = array();
		while($row = $getAll->fetch(PDO::FETCH_ASSOC)){
		  	$allDeadLine[] = array($row['id'], $row['uniqueid'], $row['expdate'], $row['status'], $row['created'] );
			}
		return $allDeadLine;
	}




























//End Of File
}