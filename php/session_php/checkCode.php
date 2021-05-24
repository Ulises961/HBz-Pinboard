<?php

session_start();

include './../registration_php/credentials.php';

$dbh = new PDO($conn_string);

$code = filter_var( $_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);

try {

    $update = "Select Count(id) AS Count FROM users";
    $where= " WHERE onetimecode=:code AND recoverymode=TRUE";
    $sql = $update.$where;

    $query= $dbh -> prepare($sql);

    $query-> bindParam(':code', $code, PDO::PARAM_STR);
   
    $query-> execute();

    $res = $query -> fetch(PDO::FETCH_ASSOC);

    
    if($res["count"] > 0){
       echo "true";
    }else{

      throw new Exception( "Something went wrong, try again");
    }


} catch (Exception $e) {
    $_SESSION["message"] = $e->getMessage();
   
    header("Location: ./../../ForgottenPassword.php",403);
   
   
}

?>
