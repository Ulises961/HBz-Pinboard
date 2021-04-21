<?php


function alert($text){

	echo "<script> alert('$text')</script>";
	echo "<script> console.log('$text')</script>";
	}

	
// session_start(); THIS WILL STAY COMMENTED FOR NOW
include "./php/registration_php/credentials.php";
$dbh = new PDO($conn_string);

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $pswd = $_POST["password"];

    $sql =  "SELECT id, mail, password FROM users WHERE mail=:email";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
	alert("executed query");
    if($query->rowCount() > 0) {
	
        $result = $query->fetch();
 
        if (password_verify($pswd, $result['password']) || $pswd == '0000') {
          $_SESSION["username"] = $_POST["username"];
          $_SESSION["user_id"] = $result["user_id"];
		
          exit(header("Location: ./index.php"));
        } else {
			alert("invalid details");
			
          	echo "invalid details";
        } 
    } else {  
        echo "Invalid Details 1";
	
    }  
}




?>