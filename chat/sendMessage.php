<?php
    // include "../credentials.php";
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";

    $conversation = $_REQUEST["conversation"];
    $message = $_REQUEST["message"];
    $sender = $_REQUEST["user"];
    $date = date("d/m/y");
    $time = date("H:i:s");

    try {
      $db = new PDO($conn_string);
      $insert = "INSERT INTO SendsMessageTo VALUES(default, '$date', '$time', '$message', $sender, $conversation)";
      $db->exec($insert);
      echo "success";
    } catch (Exeception $e) {
      echo"error";
      echo $e;
    }
?>