<?php
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";
    $conversation = $_REQUEST["conversation"];
    $time = $_REQUEST["time"];
    $date = date("d/m/y");

    try {
      $db = new PDO($conn_string);
      $query = "select * from sendsMessageTo where conversation = $conversation and date = '$date' and time > '$time'";
      $result = $db->query($query);
      $messages = array();
  
      while ($message = $result->fetch(PDO::FETCH_ASSOC))
        array_push($messages, json_encode($message));

      $result->closeCursor();

      if(empty($messages))
        echo "no new message\n";
      else{
        echo json_encode($messages);
      }

    } catch (Exeception $e) {
      echo"error";
      echo $e;
    }

?>
