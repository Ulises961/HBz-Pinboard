<?php
include "chat_credentials.php";
include "./components/menuUserRow.php";

$conversation = $_REQUEST["conversation"];

try {
  $dbh = new PDO($conn_string);

  $sql = "SELECT id, name, surname FROM Users U ". 
         "JOIN PartecipatesInConversation P ". 
         "ON P.users = U.id AND P.conversation = :conversation";

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0) 
    while($user = $query->fetch())
      createMenuUserRow($user);  

} catch (Exception $e) {
  echo $e;
}
?>