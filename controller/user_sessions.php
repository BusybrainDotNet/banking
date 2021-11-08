<?php
//required files
  require __DIR__.'/../config/db.php';
  require __DIR__.'/../model/user_session.php';
//open database connection
    $database = new dbConnect();
    $db = $database->openConnection();
//instantiate a new instance of user_session Class
    $validate = new user_session($db);
  
/*.................User Profile............................*/
if (isset($_GET['u'])) {

    $user = trim($_GET['u']);

    try { 
        $data = $validate->userSession($user);
        
        } catch (Exception $e) {
        $response = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
        echo '<meta http-equiv="refresh" content="2; URL=../auth/?ref=Back-Home">'; 
    }
}
  


