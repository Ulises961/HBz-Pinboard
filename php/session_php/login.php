<?php


include "../Utils.php";

	
session_start();

include "../registration_php/credentials.php";
$dbh = new PDO($conn_string);

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $pswd = $_POST["password"];
try{

    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    $pswd = filter_var($pswd,FILTER_SANITIZE_URL);

    $sql =  "SELECT id, password FROM users WHERE mail=:email";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();

   
        $result = $query->fetch(PDO::FETCH_ASSOC);
      
        if ($res= password_verify($pswd, $result['password'])) {
          
          $_SESSION["user_id"] = $result["id"];
		
          exit(header("Location: ../../Forum.php"));
        } else {
			throw new Exception('Invalid Credentials');
        } 
    }catch(Exception $e){
    
        $_SESSION["message"]= $e->getMessage();
   
       header("Location: ./../../Login.php");
    } 
}
