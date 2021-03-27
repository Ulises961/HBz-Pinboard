<?php
    // include "../credentials.php";
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";
    $requestUser = $_REQUEST["user"];

    try {
      $db = new PDO($conn_string);
      $result = $db->query("select c.id, c.name from conversation c, partecipatesinconversation p where c.id = p.conversation and p.users = $requestUser");
  
      $conversations = array();
      
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        array_push($conversations, json_encode($row));
        // echo $row;
      }
      $result->closeCursor();

      echo json_encode($conversations);
    } catch (Exeception $e) {
      echo"error";
      echo $e;
    }
?>