<?php


include 'php/credentials.php';

$dbh = new PDO($conn_string);

$code = filter_var( $_REQUEST["code"],FILTER_SANITIZE_NUMBER_INT);



    $update = "Select Count(id) AS Count FROM users";
    $where= " WHERE onetimecode=:code AND recoverymode=TRUE";
    $sql = $update.$where;

    $query= $dbh -> prepare($sql);

    $query-> bindParam(':code', $code, PDO::PARAM_STR);
   
    $query-> execute();

    $res = $query -> fetch(PDO::FETCH_ASSOC);

    
    if($res["count"] > 0){
       // echo var_dump($res["count"]);
       echo "true";
    }else{

      echo "false";
    }




?>
