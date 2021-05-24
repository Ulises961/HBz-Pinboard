<?php

session_start();

include './../registration_php/credentials.php';

$dbh = new PDO($conn_string);

$code = filter_var( $_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);

try {

    $update = "Select Count(*) as total FROM users";
    $where= " WHERE onetimecode=:code";
    $sql = $update.$where;

    $query= $dbh -> prepare($sql);

    $query-> bindParam(':code', $code, PDO::PARAM_STR);
    $query-> execute();

    $res = $query -> fetch(PDO::FETCH_ASSOC);
    var_dump($res);
    
    if($res["total"] > 0){
        include "component/newPassword.php";
    }else{
        throw new Exception("Something went wrong, try again");
    }


} catch (Exception $e) {
    echo $e->getMessage();
    // $_SESSION["message"] = $e->getMessage();
    // header("Location: ../../ForgottenPassword.php");
    die();
}

?>
