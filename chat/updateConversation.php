<?php
    // include "../credentials.php";
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";
    $conversation = $_REQUEST["conversation"];
    $date = date("d/m/y");
    $time = date("H:i:s");

    try {
      $db = new PDO($conn_string);
      $query = "select * from sendsMessageTo where conversation = $conversation and date = '$date' and time >= '$time'";
      $result = $db->query($query);
      $messages = array();
  
      while ($message = $result->fetch(PDO::FETCH_ASSOC))
        array_push($messages, json_encode($message));

      $result->closeCursor();

      echo json_encode($messages);

    } catch (Exeception $e) {
      echo"error";
      echo $e;
    }
?>