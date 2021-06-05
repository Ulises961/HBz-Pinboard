<?php

include '../credentials.php';

$dbh = new PDO($conn_string);
$regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/";

try {
    $newPassword = $_REQUEST["pswd"];
    $newPasswordCheck = $_REQUEST["pswd-check"];
    
    if(!(preg_match($regex, $newPassword)  && $newPassword === $newPasswordCheck)){
        throw new Exception("Password not valid!!!!");
       
    }else{
        
        $newPassword= filter_var( $newPassword ,FILTER_SANITIZE_URL);
        $code = filter_var($_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);

        $newPassword= password_hash($newPassword, PASSWORD_ARGON2I);


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
