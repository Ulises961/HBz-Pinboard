<?php
    // include "../credentials.php";
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";
    $conversation = $_REQUEST["conversation"];

    try {
      $db = new PDO($conn_string);
      $result = $db->query("select * from sendsMessageTo where conversation = $conversation order by date asc, time asc");
  
      $messages = array();
      
      while ($message = $result->fetch(PDO::FETCH_ASSOC)) {

        array_push($messages, json_encode($message));
        // echo $row;
      }
      $result->closeCursor();

      echo json_encode($messages);
    } catch (Exeception $e) {
      echo"error";
      echo $e;
    }
?>