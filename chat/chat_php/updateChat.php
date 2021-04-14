<?php
include "chat_credentials.php";
include "Messages.php";

$conversation = $_REQUEST["conversation"];
$user = $_REQUEST["user"];
$time = $_REQUEST["time"];
$date = date("d/m/y");

try {
  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM SendsMessageTo ";
  $where = "WHERE conversation = :conversation AND date = :date AND time > :time ORDER BY date ASC, time ASC";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> bindParam(':date', $date, PDO::PARAM_STR);
  $query-> bindParam(':time', $time, PDO::PARAM_STR);
  $query-> execute();

  $messages = array();

  while ($message = $query->fetch()){

    if($message["users"] != $user)
        createIncomingMessage($message);
    else
        createOutgoingMessage($message);
  }

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>
