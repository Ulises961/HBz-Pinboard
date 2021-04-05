<?php
include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];

try {
  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM SendsMessageTo ";
  $where = "WHERE conversation = :conversation ORDER BY date ASC, time ASC";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
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