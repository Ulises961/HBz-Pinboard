<?php

include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];
$new_user = $_REQUEST["newUser"];

try {
  $dbh = new PDO($conn_string);
  $sql = "INSERT INTO PartecipatesInConversation VALUES(:conversation, :user);";

  $query = $dbh -> prepare($sql);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> bindParam(':user', $new_user, PDO::PARAM_INT);
  $query-> execute();

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>