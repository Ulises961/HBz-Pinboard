<?php
include "../credentials.php";
include "components/incomingMessage.php";
include "components/outgoingMessage.php";

$isConversationPrivate = $_REQUEST["isPrivate"];
$conversation = $_REQUEST["conversation"];
$user = $_SESSION["user_id"];

try {
  $dbh = new PDO($conn_string);

  $table = "SendsMessageTo";
  
  if($isConversationPrivate == 1)
    $table = "PrivateMessageTo";

  $getMessages = "SELECT users, date, time, text, u.name AS senderName, u.picture AS senderPicture FROM $table ". 
                 "JOIN Users u ". 
                 "ON u.id = users AND conversation = :conversation ".
                 "ORDER BY date ASC, time ASC";
  
  $query = $dbh -> prepare($getMessages);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
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