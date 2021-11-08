<?php
require __DIR__.'/../mails/sendmail.php';

class registering
{
	//Declaring variables
		private $id;
		private $uniqueid;
		private $fname;
		private $lname;
		private $username;
		private $email;
		private $password;
		private $profile;
		private $code;
		private $status;
		private $login_status;
		private $hash;
		private $notify;
		private $lastlogin;
		private $created;

	//Database Connection
		private $con;
		private $db_table = "users";
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
		function setfname($fname)
		{
			$this->fname = $fname;
		}

		function getfname()
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

	//User Current Login_Status
		function setnotify($notify)
		{
			$this->notify = $notify;
		}

		function getnotify()
		{
			return $this->notify;
		}

	//User Current Login_Status
		function sethash($hash)
		{
			$this->hash = $hash;
		}

		function gethash()
		{
			return $this->hash;
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

		public function validateUser($fname, $lname, $username, $uniqueid, $email, $hash, $code, $ip, $user_agent)
	    { 
	        //check User Name
	       if (empty($fname))
	        {	// show user error
	            throw new Exception ("Name Cannot Be Empty...");    
	        }elseif (strlen($fname) < 4)
	        {	// show user error
	            throw new Exception ("First Name Too Short...");    
	        }elseif (strlen($fname) > 50)
	        {	// show user error
	            throw new Exception ("First Name Too Long...");    
	        }
	//check User Name
	       if (empty($lname))
	        {	// show user error
	            throw new Exception ("Name Cannot Be Empty...");    
	        }elseif (strlen($lname) < 4)
	        {	// show user error
	            throw new Exception ("Last Name Too Short...");    
	        }elseif (strlen($lname) > 50)
	        {	// show user error
	            throw new Exception ("Last Name Too Long...");    
	        }
	//check if Email is empty
	       if (empty($email))
	        {	// show user error
	            throw new Exception ("Email Cannot Be Empty...");    
	        }
	//check Email format
	        $email = $this->validateEmail($email);
	        if ($email == false) {
	    // show user error
	            throw new Exception("Invalid Email..."); 
	        }elseif ($this->sanitizeEmail($email) === false) {
	    // show user error
	            throw new Exception("Compromised Email..."); 
	        }
	

	//Checking email in our records
	        $user = $this->userExistsInDB($uniqueid, $email);
	        if ($user == false) {    // code...
	            $user = $this->insertUserInDB($fname, $lname, $username, $uniqueid, $email, $hash, $code, $ip, $user_agent);
	        }
	// Return result...
	        return $user;
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





//Function For Activation Link
	    public function activateUser($user, $email)
	    {
	    	$query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':email', $email);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);

	    	if(($data == true) && ($data['password'] == NULL)){
	    		$this->sendUserMail($user, $email);
	    	}elseif(($data == true) && ($data['password'] != NULL)){
	    		throw new Exception("ERROR!<br><br>This Account Has Been Set<br><br>Login Instead Or Reset Your Password...");
	    	}else{
	    		throw new Exception("ERROR!<br><br>This Credentials Is Not Found...");
	    	}
	    }

	//Function to check Email in our records
	    protected function userExistsInDB($uniqueid, $email){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':email', $email);
	        $stmt->bindParam(':uniqueid', $uniqueid);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	        $RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount > 0) {    // code...
	        	throw new Exception("ERROR!<br><br>User Already Exists<br>Confirm Your Account And Login Instead<br>Check Your Email Inbox or Spam Folder For Verification Email...");
	        }
	// Return result...
	    return $user;
	    }



	/*.....User Registration And Email Verification Function ...........*/

	//Function to save User Credentials into Database
	    protected function insertUserInDB($fname, $lname, $username, $uniqueid, $email, $hash, $code, $ip, $user_agent)
	    {	// Insert The Information...
	        $query = "INSERT INTO " . $this->db_table . " 
	        (fname, lname, username, uniqueid, email, hash, code, ip, user_agent) VALUES 
	        (:fname, :lname, :username, :uniqueid, :email, :hash, :code, :ip, :user_agent)";
	        $stmt = $this->con->prepare($query);
	        $data = array(
		        "fname" => $fname,
		        "lname" => $lname,
		        "username" => $username,
		        "uniqueid" => $uniqueid,
		        "email" => $email,
		        "hash" => $hash,
		        "code" => $code,
		        "ip" => $ip,
		        "user_agent" => $user_agent,
	        );
	        $stmt->execute($data);
	        $user = $this->sendUserMail($uniqueid, $email);
	    }



	//Function to Send User Credentials To User
	    private function sendUserMail($uniqueid, $email)
	    {	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':email', $email);
	        $stmt->bindParam(':uniqueid', $uniqueid);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);

	        if ($user == true) {
	        	// Send User Email If All Criteria Met...
	    		$mailSender = new sendMail();
	         $user = $mailSender->regConf($user);
	      }else{
	        	throw new Exception("Error Processing Your Request");
	        }
	    }



	/*................User Confirmation Function ...............*/

	//Function to Confirm user record
		public function setUpUser($uniqueid, $username, $accnum1, $accnum2, $pin, $hash)
	    	{  //Checking email in our records
	        $data = $this->checkUser($uniqueid, $hash, $username);
	        if ($data == true) {
	          $this->userConfirm($uniqueid, $accnum1, $accnum2, $pin, $hash);
	      }
	    }

	//Function to check Email in our records
	    protected function checkUser($uniqueid, $hash, $username){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid || username = :username AND hash = :hash LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $uniqueid);
	        $stmt->bindParam(':hash', $hash);
	        $stmt->bindParam(':username', $username);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        if ($user['hash'] == $hash) {
	        	throw new Exception("ERROR! <br>Your Account Could Not Be Set Up<br>Follow The Link Again Or Contact Support...");
	        }elseif ($user['password'] != NULL) {
	        	throw new Exception("ERROR! <br>Account Was Previously Set Up, Login Instead <br>Use The Forgot Password Link <br>If Problem Persists, Use The Login Help Link...");
	        }elseif ($user['status'] == "Deactivated") {
	        	throw new Exception("ERROR! <br>Account Was Deactivated <br>Write Us Or Contact Support...");
	        }
	       return $user;
	    }



	//Function to Confirm user record
	    protected function userConfirm($uniqueid, $accnum1, $accnum2, $pin){
	    	$query = "SELECT * FROM profile WHERE uniqueid = :uniqueid LIMIT 1";
	        $stmt1 = $this->con->prepare($query);
	        $stmt1->bindParam(':uniqueid', $uniqueid);
	        $stmt1->execute();
	        $user = $stmt1->fetch(PDO::FETCH_ASSOC);
	        $RowCount = $stmt1->rowCount();
	// Checking all User credentials...
	        if ($RowCount > 0) {
	        	throw new Exception("ERROR! <br>Account Was Previously Confirmed, Continue To Setup..."); 
	        }else{

		  $query = "INSERT INTO profile (uniqueid) VALUES (:uniqueid)";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $data = $sql->execute();

		  if($data == true){
		  	$query = "INSERT INTO accdetails (uniqueid, accnum1, accnum2, pin) VALUES (:uniqueid, :accnum1, :accnum2, :pin)";
		  $stmt = $this->con->prepare($query);
		  $stmt->bindParam(':uniqueid', $uniqueid);
		  $stmt->bindParam(':accnum1', $accnum1);
		  $stmt->bindParam(':accnum2', $accnum2);
		  $stmt->bindParam(':pin', $pin);
		  $user = $stmt->execute();

		  if($user == false){
		  		throw new Exception("Error Confirming Your Account, Try Again Later...");	
		  		} 
		  }
		}
	return $user;
	}



	//Function to Confirm user record
	    public function verifyUser($uniqueid, $gender, $licence, $ssn, $filename){

		  $query = "UPDATE profile SET `gender` = :gender, `licence` = :licence, `ssn` = :ssn, `idfront` = :idfront WHERE uniqueid = :uniqueid LIMIT 1";
		  $sql = $this->con->prepare($query);
		  $sql->bindParam(':gender', $gender);
		  $sql->bindParam(':licence', $licence);
		  $sql->bindParam(':ssn', $ssn);
		  $sql->bindParam(':idfront', $filename);
		  $sql->bindParam(':uniqueid', $uniqueid);
		  $user = $sql->execute([':gender' => $gender, ':licence' => $licence, ':ssn' => $ssn, ':uniqueid' => $uniqueid, ':idfront' => $filename ]);

		  if (! $user == true) {
		  	throw new Exception("Error!<br>Account Set Failed, Try Again Later...");	
		  }
	// Return result...
		  return $user;  
		}



		public function firstTimeUser($user){
			// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE username = :username || uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->bindParam(':email', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        if ($data == false) { 
	        	throw new Exception("Invalid Account Credentials...");
	        }elseif ($data['password'] != NULL) {
	        	throw new Exception("This Account Has Been Previously Activated<br>Login Or Reset Your Password...");
	        }
		}



	public function firstTimePass($user, $password, $cpassword)
		{
			//check if Password
       if (empty($password))
        {	 // show user error
            throw new Exception ("Password Cannot Be Empty...");    
        }elseif (empty($cpassword))
        {	// show user error
           throw new Exception ("Password Cannot Be Empty...");
        }elseif ($password != $cpassword)
        {	// show user error
           throw new Exception ("Password Must Be Same...");
        }else{

        $query = "SELECT * FROM " . $this->db_table ." WHERE username = :username || uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt1 = $this->con->prepare($query);
	        $stmt1->bindParam(':uniqueid', $user);
	        $stmt1->bindParam(':username', $user);
	        $stmt1->bindParam(':email', $user);
	        $stmt1->execute();
	        $user = $stmt1->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        if ($user['password'] != NULL) {
	        	throw new Exception("ERROR!<br><br>Account Was Previously Set Up<br>Continue To Login Or Use The Forgot Password Link...");
	        }else{
	        	$query = "UPDATE " . $this->db_table ." SET `password` = :password WHERE uniqueid = :uniqueid LIMIT 1";
			  $sql = $this->con->prepare($query);
			  $sql->bindParam(':password', $password);
			  $sql->bindParam(':uniqueid', $user['uniqueid']);

			  $data = $sql->execute([':password' => password_hash($password, PASSWORD_DEFAULT), ':uniqueid' => $user['uniqueid'], ]);
			   if (!$data == true) {
			  	throw new Exception("Error Setting Password, Try Again Later...");	
			  		}
				}
			}
	}


//Reset User Password
public function resetPass($user, $password, $cpassword)
		{
			//check if Password
       if (empty($password))
        {	 // show user error
            throw new Exception ("Password Cannot Be Empty...");    
        }elseif (empty($cpassword))
        {	// show user error
           throw new Exception ("Password Cannot Be Empty...");
        }elseif ($password != $cpassword)
        {	// show user error
           throw new Exception ("Password Must Be Same...");
        }else{

	        	$query = "UPDATE " . $this->db_table ." SET `password` = :password WHERE username = :username || uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':email', $user); 
			  $stmt->bindParam(':password', $password);

			  $user = $stmt->execute([':password' => password_hash($password, PASSWORD_DEFAULT), ':uniqueid' => $user, ':email' => $user, ':username' => $user ]);
			   if (!$user == true) {
			  	throw new Exception("Error Setting Password, Try Again Later...");	
			  	}
			}
	}


	//Function to Help User Login
	    public function helpUserLogin($user){
	    	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE username = :username || uniqueid = :uniqueid || email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':username', $user);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->bindParam(':email', $user);
	        $stmt->execute();
	        $data = $stmt->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        if ($data == false) { 
	        	throw new Exception("Invalid Member Account Credentials<br>Check Your Record And Try Again...");
	        }else{
	        	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM security WHERE uniqueid = :uniqueid LIMIT 1";
	        $sql = $this->con->prepare($query);
	        $sql->bindParam(':uniqueid', $data['uniqueid']);
	        $sql->execute();
	        $data1 = $sql->fetch(PDO::FETCH_ASSOC);
	// Checking all User credentials...
	        $_SESSION['uniqueid']  = $data1['uniqueid'];
	        $_SESSION['secq1']  = $data1['secq1'];
	        $_SESSION['secq2']  = $data1['secq2'];
	        $_SESSION['seca1']  = $data1['seca1'];
	        $_SESSION['seca2']  = $data1['seca2'];

	        if (($data1 == false) || ($data1['secq1'] == Null)) { 
	        	throw new Exception("You Have Not Set Security Questions For This Account.<br>You Need To Contact Support For Help...");
	        	}
  			}
		}


//Function To Process Subscription Payment
public function subPayment($uniqueid, $email, $amount, $descrip, $ip, $user_agent){
	// Fetch and verify if the record already exists...
    $query = "INSERT INTO subpay (uniqueid, email, amount, descrip, ip, user_agent) VALUES (:uniqueid, :email, :amount, :descrip, :ip, :user_agent)";

	    $sql = $this->con->prepare($query);
	    $sql->bindParam(':uniqueid', $uniqueid);
	    $sql->bindParam(':email', $email);
	    $sql->bindParam(':amount', $amount);
	    $sql->bindParam(':descrip', $descrip);
	    $sql->bindParam(':ip', $ip);
	    $sql->bindParam(':user_agent', $user_agent);
	    $user = $sql->execute();

     if ($user == true) {
     	// Send User Email If All Criteria Met...
	    		$mailSender = new sendMail();
	         $user = $mailSender->payConf($user);
		}			    
	}


















//End of file
}