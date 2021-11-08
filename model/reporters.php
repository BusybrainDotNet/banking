<?php
require __DIR__.'/../mails/sendmail.php';

class reporters 
{
		//Declaring variables
		private $id;
		private $fname;
		private $lname;
		private $eemail;
		private $number;
		private $subject;
		private $status;
		private $details;
		private $created;

	//Database Connection
		private $con;
		private $db_table = "msgreport";
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

		//NAME 
		function setFname($fname)
		{
			$this->fname = $fname;
		}

		function getFname()
		{
			return $this->fname;
		}
		//NAME 
		function setLname($lname)
		{
			$this->lname = $lname;
		}

		function getLname()
		{
			return $this->lname;
		}

		//ID 
		function setEmail($email)
		{
			$this->email = $email;
		}

		function getEmail()
		{
			return $this->email;
		}
		//Subject 
		function setSubject($subject)
		{
			$this->subject = $subject;
		}

		function getSubject()
		{
			return $this->subject;
		}
		//Number 
		function setNumber($number)
		{
			$this->number = $number;
		}

		function getNumber()
		{
			return $this->number;
		}
		//Details 
		function setDetails($details)
		{
			$this->details = $details;
		}

		function getDetails()
		{
			return $this->details;
		}


	/*..................report Login Function ..........................*/

		public function newreport($fname, $lname, $email, $number, $subject, $details, $ip, $status, $user_agent)
	    {  
	    	//check Eemail format
        $email = $this->validateEmail($email);
        if ($email == false) {
    // show user error
            throw new Exception("Invalid Eemail..."); 
        }elseif ($this->sanitizeEmail($email) === false) {
    // show user error
            throw new Exception("Compromised Eemail..."); 
        }

	//Checking email in our records
        $data = $this->confirmReport($email, $subject);
        $this->createReport($fname, $lname, $email, $number, $subject, $details, $ip, $status, $user_agent);

	}


//Function to validate Eemail
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




	//Function to check email in our records
	    protected function confirmReport($email, $subject){
	// Fetch and verify if the record already exists...
	        $query = "SELECT * FROM " . $this->db_table ." WHERE email = :email AND subject = :subject LIMIT 1";
	        $stmt = $this->con->prepare($query);
	        $stmt->bindParam(':email', $email);
	        $stmt->bindParam(':subject', $subject);
	        $stmt->execute();
	        $stmt->fetch(PDO::FETCH_ASSOC);    
	      	$RowCount = $stmt->rowCount();
	// Checking all report credentials...
	        if ($RowCount > 0) {
	        	throw new Exception("This Report Is Under Review, Check Later...");
	        }
   		}



//Function to check email in our records
	    protected function createReport($fname, $lname, $email, $number, $subject, $details, $ip, $status, $user_agent){
			$query = "INSERT INTO " . $this->db_table . " (fname, lname, email, number, subject, details, ip, status, user_agent) VALUES 
	        (:fname, :lname, :email, :number, :subject, :details, :ip, :status, :user_agent)";
	        $sql = $this->con->prepare($query);
	        $sql->bindParam(':fname', $fname);
	        $sql->bindParam(':lname', $lname);
	        $sql->bindParam(':email', $email);
	        $sql->bindParam(':number', $number);
	        $sql->bindParam(':status', $status);
	        $sql->bindParam(':subject', $subject);
	        $sql->bindParam(':details', $details);
	        $sql->bindParam(':ip', $ip);
	        $sql->bindParam(':user_agent', $user_agent);
	        $data = $sql->execute();

		  if (!$data) {
		  	throw new Exception("Error On Submission...<i class='fa fa-spinner fa-spin'></i>");	  	
		  }

        }







}

?>