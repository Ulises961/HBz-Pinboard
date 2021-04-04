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
      $dbh = new PDO($conn_string);
      $select_from = "SELECT * FROM SendsMessageTo ";
      $where = "WHERE conversation = :conversation AND date = :date AND time > :time";
      
      $sql = $select_from.$where;
      $query = $dbh -> prepare($sql);

      $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
      $query-> bindParam(':date', $date, PDO::PARAM_STR);
      $query-> bindParam(':time', $time, PDO::PARAM_STR);
      $query-> execute();

      $messages = array();
  
      while ($message = $query->fetch())
        array_push($messages, json_encode($message));

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
