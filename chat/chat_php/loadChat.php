<?php
include "chat_credentials.php";
include "Messages.php";

$conversation = $_REQUEST["conversation"];
$user = $_REQUEST["user"];

try {
  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM SendsMessageTo ";
  $where = "WHERE conversation = :conversation ORDER BY date ASC, time ASC";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> execute();

  $messages = array();

  while ($message = $query->fetch()){

    if($message["users"] != $user)
        createIncomingMessage($message);
    else
        createOutgoingMessage($message);
  }

} catch (Exeception $e) {
  echo"error";
  echo $e;
}
?>