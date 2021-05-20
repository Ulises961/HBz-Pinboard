<?php
include "chat_credentials.php";

// right now we are onlu testing and there is no session vairable set
// $user = $_SESSION["user"]; 
$user = 1; 

try {
  $dbh = new PDO($conn_string);

  $select = "SELECT id, name, last_change, last_message ";
  $from = "FROM conversation , partecipatesinconversation ";
  $where = "WHERE id = conversation AND users = :user";

  $sql =  $select.$from.$where;

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0) {
    $conversations = array();

    while($row = $query->fetch())
      array_push($conversations, json_encode($row));
      
    echo json_encode($conversations);
  } 

} catch (Exception $e) {
  echo $e;
}
?>