<?php
require __DIR__.'/../mails/sendmail.php';

class subscriber 
{
		//Declaring variables
		private $id;
		private $name;
		private $email;
		private $ip;
		private $user_agent;
		private $created;

	//Database Connection
		private $con;
		private $db_table = "subscribe";
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

	//User Email
		function setemail($email)
		{
			$this->email = $email;
		}

		function getemail()
		{
			return $this->email;
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

		

	/*..................User Login Function ..........................*/

		public function newsub($ip, $email, $name, $user_agent)
	    {  
	    	//check Email format
        $email = $this->validateEmail($email);
        if ($email == false || $email == NULL) {
    // show user error
            throw new Exception("Invalid Email..."); 
        }elseif ($this->sanitizeEmail($email) === false) {
    // show user error
            throw new Exception("Compromised Email..."); 
        }
	//Checking email in our records
	        $data = $this->confirmUser($ip, $email, $name, $user_agent);
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
    protected function sanitizeUser_id($user_id){
// Return result...
        return filter_var($user_id, FILTER_SANITIZE_STRING);
    }



	//Function to check Email in our records
	    protected function confirmUser($ip, $email, $name, $user_agent){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE email = :email LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':email', $email);
	        $stmt->execute();
	        $user = $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all User credentials...
	        if ($RowCount > 0) {
	        	throw new Exception("You Are Previously Subscribed...");
	        }else{
	        	$user = $this->createSubscriber($ip, $email, $name, $user_agent);
	        	// Send User Email...	
	        $mailSender = new sendMail();
	        $user = $mailSender->subscriberConf($email, $name);
	        }
	    }



	//Function to update user record
	    protected function createSubscriber($ip, $email, $name, $user_agent){

		 	$query = "INSERT INTO " . $this->db_table . " (ip, email, name, user_agent) VALUES 
	        (:ip, :email, :name, :user_agent)";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':name', $name);
	        $stmt->bindParam(':email', $email);
	        $stmt->bindParam(':ip', $ip);
	        $stmt->bindParam(':user_agent', $user_agent);
	        $user = $stmt->execute();

		  if ($user == false) {
	            throw new Exception("Error Subscribing...<i class='fa fa-spinner fa-spin'></i>");	
			} 
		}




}

?>