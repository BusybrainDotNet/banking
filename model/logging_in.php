<?php
require __DIR__.'/../mails/sendmail.php';
/**
 * 
 */
class logging_in 
{

		//Declaring variables
		private $id;
		private $fname;
		private $lname;
		private $uniqueid;
		private $username;
		private $email;
		private $password;
		private $code;
		private $status;
		private $login_status;
		private $notify;
		private $lastlogin;
		private $created;

	//Database Connection
		private $con;
		private $db_table = "users";
	/*//Email Sender
		private $mailSender;*/

	//Function to construct pdo interface for connection
		public function __construct($db)
		{
			$this->con = $db;
			$this->lastlogin = date("y-m-d H:i:s");
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

	//User Firstname
		function setFname($fname)
		{
			$this->fname = $fname;
		}

		function getFname()
		{
			return $this->fname;
		}

	//User Lastname
		function setlname($lname)
		{
			$this->lname = $lname;
		}

		function getlname()
		{
			return $this->lname;
		}

		//User Username
		function setuniqueid($uniqueid)
		{
			$this->uniqueid = $uniqueid;
		}

		function getuniqueid()
		{
			return $this->uniqueid;
		}

	//User Username
		function setusername($username)
		{
			$this->username = $username;
		}

		function getusername()
		{
			return $this->username;
		}

	//User Email
		function setemail($email)
		{
			$this->email = $email;
		}

		function getemail()
		{
			return $this->email;
		}

	//User Password
		function setpassword($password)
		{
			$this->password = $password;
		}

		function getpassword()
		{
			return $this->password;
		}

	//User code
		function setcode($code)
		{
			$this->code = $code;
		}

		function getcode()
		{
			return $this->code;
		}

	//User Account Status
		function setStatus($status)
		{
			$this->status = $status;
		}

		function getStatus()
		{
			return $this->status;
		}
	//User Login Status
		function setLoginStatus($login_status)
		{
			$this->login_status = $login_status;
		}

		function getLoginStatus()
		{
			return $this->login_status;
		}

	//User Current Login_Status
		function setnotify($notify)
		{
			$this->notify = $notify;
		}

		function getnotify()
		{
			return $this->notify;
		}

	//Time Of User Last Login
		function setLast_Login($lastlogin)
		{
			$this->lastlogin = $lastlogin;
		}

		function getLast_Login()
		{
			return $this->lastlogin;
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

/*.................Form Validation ...............................*/

	public function validateUser($user, $password, $code, $login_status, $lastlogin, $ip, $user_agent)
    {  
//check User Name
       if (empty($user))
        {	// show user error
            throw new Exception ("Name Cannot Be Empty...");    
        }elseif (strlen($user) < 5)
        {	// show user error
            throw new Exception ("User Name Too Short...");    
        }elseif (strlen($user) > 50)
        {	// show user error
            throw new Exception ("User Name Too Long...");    
        }

//check if Password
       if (empty($password))
        {	 // show user error
            throw new Exception ("Password Cannot Be Empty...");    
        }

//check User Name format
        if ($this->sanitizeUser($user) === false) {
    // show user error
            throw new Exception("Compromised User Name..."); 
        }
//Checking email in our records
        $data = $this->userExistsInDB($user);

        if ($data == true) {    // code...
            $this->confirmUser($user, $password, $ip, $user_agent);
        }

	    if ($data == true) {
	         $data = $this->updateUser($user, $code, $login_status, $lastlogin, $ip, $user_agent); 
	          $this->redirectUser($user, $user_agent, $ip);
	        }
	// Return result...
	        return $data;
    }

//Function to validate Email
    protected function validateEmail($email){
// Return result...
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
//Function to Sanitize Fields
    protected function sanitizeEmail($email){
// Return result...
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }
//Function to Sanitize Fields
    protected function sanitizeUser($user_id){
// Return result...
        return filter_var($user_id, FILTER_SANITIZE_STRING);
    }


		

	/*..................User Login Function ..........................*/

//Function to check Email in our records
	    protected function userExistsInDB($user){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE username = :username || email = :email || uniqueid = :uniqueid LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':email', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount == 0) {
	        	throw new Exception("Error!<br><br>You Are Not A Registered Member...");
	        }elseif ($data['password'] == NULL) {
	        	throw new Exception("Error!<br><br>Your Account Has Not Been Set Up.<br>Use The First Time Logging In Link To Complete Setup...");
	        }elseif (($RowCount > 0) && ($data['uniqueid'] == true)) {
	        	$query = "SELECT * FROM profile WHERE uniqueid = :uniqueid LIMIT 1";
		        $stmt1 = $this->con->prepare($query);
		        $stmt1->bindParam(':uniqueid', $data['uniqueid']);
		        $stmt1->execute();
		        $data1 = $stmt1->fetch(PDO::FETCH_ASSOC);    
		      	$RowCount1 = $stmt1->rowCount();
		        if ($RowCount1 === 0) {
	        	throw new Exception("Error!<br><br>Incorrect Email, User Name or Unique ID. <br>Your Account Might Be Unactivated<br>Request a New Confirmation Link<br> Also Check Your Email Inbox or Spam Folder For Activation Email...");
	        	}
	        }
	        return $data1;
	    }

	//Function to check Email in our records
	    protected function confirmUser($user, $password, $ip, $user_agent){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE username = :username || email = :email || uniqueid = :uniqueid LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':email', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount < 0) {
	        	throw new Exception("Unregistered Credentials, Register First...");
	        }elseif ($data['status'] == 'Deactivated') {
				throw new Exception("ERROR!<br><br>You Do Not Have Access To This Account Anymore<br>Contact Support For Help...");
			}elseif (!password_verify($password, $data['password'])){
					throw new Exception("ERROR!<br><br>Your Password Combination Is Incorrect...");
			}elseif ($data['login_status'] == 'Logged_in'){
					throw new Exception("Active Session Detected <br> Logout From All Devices And Retry...");
			}
	// Return result...
			return $data;
	    }



	//Function to update user record
	    protected function updateUser($user, $code, $login_status, $lastlogin, $ip, $user_agent){
		  $query = "UPDATE " . $this->db_table ." SET `code` = :code, `login_status` = :login_status, `lastlogin` = :lastlogin, `ip` = :ip, `user_agent` = :user_agent WHERE username = :username || email = :email || uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $user);
		  $sql->bindParam(':username', $user);
		  $sql->bindParam(':email', $user);
		  $sql->bindParam(':code', $code);
		  $sql->bindParam(':login_status', $login_status);
		  $sql->bindParam(':lastlogin', $lastlogin);
		  $sql->bindParam(':ip', $ip);
		  $sql->bindParam(':user_agent', $user_agent);

		  $data = $sql->execute([':code' => $code, ':login_status' => $login_status, ':lastlogin' => date('Y-m-d H:i:s'), ':uniqueid' => $_POST['user'],  ':username' => $_POST['user'], ':email' => $_POST['user'], ':ip' => $_POST['ip'], ':user_agent' => $_POST['user_agent'] ]);

		  if (!$data = $sql->execute()) {
		  	throw new Exception("Error Logging You In At This Time<br>Try Again After Sometime...");	  	
		  }
	// Return result...
		  return $data;  
		}


	//Function to redirect users
	protected function redirectUser($user, $user_agent, $ip){
	  $mailSender = new sendMail();

	  $query = "SELECT * FROM " . $this->db_table ."  WHERE username = :username || email = :email || uniqueid = :uniqueid LIMIT 1";
	  $sql = $this->con->prepare($query);
	  $sql->bindParam(':uniqueid', $user);
	  $sql->bindParam(':username', $user);
	  $sql->bindParam(':email', $user);
	  $sql->execute();
	  $user = $sql->fetch(PDO::FETCH_ASSOC);

	  //Session Starts
	  $_SESSION['uniqueid']  = $user['uniqueid'];
	  $_SESSION['email']  = $user['email'];
      $_SESSION['fname'] = $user['fname'];
      $_SESSION['lname'] = $user['lname'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['status'] = $user['status'];
      $_SESSION['profile'] = $user['profile'];
      $_SESSION['code'] = $user['code'];
      $_SESSION['lastlogin'] = $user['lastlogin'];
      $_SESSION['created'] = $user['created'];
      $_SESSION['last_login_created'] = time();

	  if ($user_agent != $user['user_agent'] && $ip != $user['ip']) {
	// Send User Email If All Criteria Met...
	  	$user =	$mailSender->locationMail($user);
		echo '<meta http-equiv="refresh" content="5; URL=../auth/lock?u_s=Enabled&u='.$user['uniqueid'].'&2fa='.$user['notify'].'">';

		}elseif ($user['notify'] == 'On'){
	// Send User Email If All Criteria Met...
        	$user =	$mailSender->notifyOn($user);

		echo '<meta http-equiv="refresh" content="5; URL=../auth/lock?u_s=Enabled&u='.$user['uniqueid'].'&2fa='.$user['notify'].'">';

        }elseif ($user['profile'] == 'Admin' && $user['notify'] != 'On'){
	echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/super/?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">'; 
		}elseif ($user['profile'] == 'Moderator' && $user['notify'] != 'On') {
	echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/mode/?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">';
		}elseif ($user['profile'] == 'User' && $user['notify'] != 'On') {
	echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/dashboard/?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">'; 
		}
// Return result...
	return $user;
	}


	/*...............User Password Reset Function ................*/

	//Function to Confirm user record
		public function passRequest($user)
	    	{  //Checking user in our records
	        $data = $this->userInfo($user);
	// Return result...
	        return $data;
	    }

	//Function to check Email in our records
	    protected function userInfo($user){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid || username = :username || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':email', $user);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount === 0) {
	        	throw new Exception("Unregistered Credentials, Register First...");
	        }elseif ($user['status'] == 'Deactivated') {
				throw new Exception("Unactivated Or Disabled Account...");
			}elseif ($user['password'] == NULL) {
				throw new Exception("Your Account Is Yet To Be Confirmed, Return To Your Email Link...");
			}
			// Send User Email If All Criteria Met...
	    	$mailSender = new sendMail();
	        $user = $mailSender->passMail($user);

	// Return result...
			return $user;
	    }


	/*.................Form Validation .........................*/

		public function newPassReset($user, $code, $password)
	    {	//Update Password in our records
	        $data = $this->confCode($user, $code, $password);
	        if ($data == true) {    // code...
	           $data = $this->updatePass($user, $password);
	        }
	// Return result...
	        return $data;
	    }


	//Function to check Email in our records
	    protected function confCode($user, $code, $password){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid && code = :code LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':code', $code);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount === 0) {
	        	throw new Exception("Expired Or Incorrect Credentials...");
	        }elseif (password_verify($password, $data['password'])){
					throw new Exception("This Password Was Recently Used...");
			}
	        return $data;
		}


	//Function to update user password
	    protected function updatePass($user, $password){
		  $query = "UPDATE " . $this->db_table ." SET `password` = :password WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':password', $password);
		  $sql->bindParam(':uniqueid', $user);
		  $user = $sql->execute([':uniqueid' => $user, ':password' => password_hash($password, PASSWORD_DEFAULT) ]);
		  if (!$user = $sql->execute()) {
		  	throw new Exception("Error Updating Password...");	  	
		  }
	// Return result...
		  return $user;  
		}



	/*.................2FA User Login................................*/

		public function authenticate($user, $code)
	    {	//Validate Code Format
	    	if (strlen($code) > 6 || strlen($code) < 6) {
	    		throw new Exception("Wrong code Format...");   		
	    	}
	    //Verify Code in our records
	        $user = $this->verifyCode($user, $code);
	// Return result...
	        return $user;
	    }


	//Function to check Email in our records
	    protected function verifyCode($user, $code){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE email = :email || username = :username || uniqueid = :uniqueid AND code = :code LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':code', $code);
	        $stmt->bindParam(':email', $user);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        $_SESSION['email']  = $user['email'];
	      	$_SESSION['fname'] = $user['fname'];
	      	$_SESSION['lname'] = $user['lname'];
	      	$_SESSION['uniqueid'] = $user['uniqueid'];
	      	$_SESSION['username'] = $user['username'];
	      	$_SESSION['status'] = $user['status'];
	      	$_SESSION['profile'] = $user['profile'];
	      	$_SESSION['code'] = $user['code'];
	      	$_SESSION['lastlogin'] = $user['lastlogin'];
	      	$_SESSION['created'] = $user['created'];
	      	$_SESSION['last_login_created'] = time();

	        if ($code != $user['code']) {
	        	throw new Exception("Expired Or Incorrect Credentials...");
	        }elseif ($user['profile'] == 'Admin'){
		echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/super/?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">'; 
			}elseif ($user['profile'] == 'Moderator') {
		echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/mode/?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">'; 
			}elseif ($user['profile'] == 'User') {
		echo '<meta http-equiv="refresh" content="5; URL=../onbank-user/dashboard?u='.$user['uniqueid'].'&s='.$user['status'].'&t='.$user['lastlogin'].'&d=true">'; 
			}
		return $user;
		}






//Function to check Email in our records
	    public function endSession($user, $login_status){
	    	$data = $this->userExistsInDB($user);
	// Fetch and verify if the record already exists...
	      $query = "UPDATE ". $this->db_table ." SET `login_status` = :login_status WHERE uniqueid = :uniqueid || email = :email || username = :username LIMIT 1";
		  $sql = $this->con->prepare($query);	  
		  $sql->bindParam(':uniqueid', $user);
		  $sql->bindParam(':email', $user);
		  $sql->bindParam(':username', $user);
		  $sql->bindParam(':login_status', $login_status);
		  $data = $sql->execute([':uniqueid' => $user, ':email' => $user, ':username' => $user, ':login_status' => $login_status]);
		  $data = session_unset();
		  if ($data != true) {
		  	throw new Exception("Error Processing Request");
		  }
		}









}

?>