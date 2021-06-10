<?php

include "../credentials.php";

$conversation = $_REQUEST["conversation"];
$new_user = $_REQUEST["newUser"];
$isAdmin = false;
try {
  $dbh = new PDO($conn_string);
  $sql = "INSERT INTO PartecipatesInConversation VALUES(:conversation, :user, :isAdmin);";

  $query = $dbh -> prepare($sql);

  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> bindParam(':user', $new_user, PDO::PARAM_INT);
  $query-> bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL);
  $query-> execute();

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>