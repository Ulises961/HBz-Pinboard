<?php

session_start();
include './../registration_php/credentials.php';

$dbh = new PDO($conn_string);


try {
    $newPassword = $_REQUEST["pswd"];
    
    if(strlen($newPassword)<6){
        throw new Exception("Password not valid");
       
    }else{
        
        $newPassword= filter_var( $newPassword ,FILTER_SANITIZE_URL);
        $code = filter_var($_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);

    

        $update = "UPDATE users SET password =:password, onetimecode=NULL, recoveryMode=FALSE";
        $where= " WHERE onetimecode=:code AND recoverymode=TRUE RETURNING *";
        $sql = $update.$where;

        $query= $dbh -> prepare($sql);
        $query-> bindParam(':password', $newPassword, PDO::PARAM_STR);
        $query-> bindParam(':code', $code, PDO::PARAM_STR);
        $query-> bindParam(':mail', $mail, PDO::PARAM_STR);
        
        $query-> execute();
        $resulting = $query-> fetch();
        var_dump($resulting);
        $_SESSION["message"] = "Password updated successfully";
        header("Location: ../../Login.php");
    }
} catch (Exception $e) {
    
    $_SESSION["message"] = $e-> getMessage();
    header("Location: ../../ForgottenPassword.php");
}

?>
