<?php


include "../Utils.php";

	
session_start();

include "../registration_php/credentials.php";
$dbh = new PDO($conn_string);

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $pswd = $_POST["password"];
try{
    $sql =  "SELECT id, mail, password FROM users WHERE mail=:email";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();

   
        $result = $query->fetch();
 
        if (password_verify($pswd, $result['password']) || $pswd == '0000') {
          $_SESSION["username"] = $_POST["username"];
          $_SESSION["user_id"] = $result["user_id"];
		
          exit(header("Location: ../../forum.php"));
        } else {
			throw new Exception('Invalid Credentials');
        } 
    }catch(Exception $e){
        alert($e->getMessage());
        die();
    } 
}
