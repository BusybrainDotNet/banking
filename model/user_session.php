<?php

class user_session
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
		function setusername($username)
		{
			$this->username = $username;
		}

		function getusername()
		{
			return $this->username;
		}


		//User Unique ID
		function setuniqueid($uniqueid)
		{
			$this->uniqueid = $uniqueid;
		}

		function getuniqueid()
		{
			return $this->uniqueid;
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



//Checking User Credentials To Stay Logged In
	public function userSession($user)
	{
		// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE uniqueid = :uniqueid LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':uniqueid', $user);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);
	        $RowCount = $stmt->rowCount();

	        $user['hash'] = substr($user['hash'], 20);
	        $user['uniqueid1'] = substr($user['uniqueid'], 0, 5);

	// Passing all User credentials...
	        $_SESSION['uniqueid']  = $user['uniqueid'];
	        $_SESSION['email']  = $user['email'];
	      	$_SESSION['fname'] = $user['fname'];
	      	$_SESSION['lname'] = $user['lname'];
	      	$_SESSION['username'] = $user['username'];
	      	$_SESSION['uniqueid1'] = $user['uniqueid1'];
	      	$_SESSION['status'] = $user['status'];
	      	$_SESSION['profile'] = $user['profile'];
	      	$_SESSION['lastlogin'] = $user['lastlogin'];
	      	$_SESSION['hash'] = $user['hash'];
	      	$_SESSION['ip'] = $user['ip'];
	      	$_SESSION['user_agent'] = $user['user_agent'];
	      	$_SESSION['notify'] = $user['notify'];
	      	$_SESSION['login_status'] = $user['login_status'];
	      	$_SESSION['last_login_created'] = time();

	// Checking all User credentials...
	        if ($RowCount <= 0) {
	        	throw new Exception("Unregistered Credentials, Register First...");
	        }elseif ($user['status'] === 'Deactivated') {
				throw new Exception("This Account Has Been Deactivated<br>Contact Support...");
			}elseif ($user['login_status'] != "Logged_in") {
				throw new Exception("Sorry, You Need To Login Again...");
			}elseif (!isset($user['uniqueid'])) {
				throw new Exception("Sorry, You Need To Login Again...");
			}
	}












	//end of file

}