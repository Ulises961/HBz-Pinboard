<?php

session_start();
include './../registration_php/credentials.php';

$dbh = new PDO($conn_string);

$newPassword= filter_var( $_REQUEST["pswd"],FILTER_SANITIZE_URL);
$code = filter_var( $_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);
var_dump($newPassword);
$newPassword = password_hash($newPassword, PASSWORD_ARGON2I);
var_dump($newPassword);
try {

    $update = "UPDATE users SET password =:password, onetimecode=0";
    $where= " WHERE onetimecode=:code RETURNING *";
    $sql = $update.$where;

    $query= $dbh -> prepare($sql);
    $query-> bindParam(':password', $newPassword, PDO::PARAM_STR);
    $query-> bindParam(':code', $code, PDO::PARAM_STR);


    
    $query-> execute();
    $resulting = $query-> fetch();
    var_dump($resulting);
    // $_SESSION["message"] = "Password updated successfully";
    // header("Location: ../../Login.php");
} catch (Exception $e) {
    // $dbh -> rollBack();
    // $_SESSION["message"] = "Something went wrong, try again";
    // header("Location: ../../ForgottenPassword.php");
}

?>
