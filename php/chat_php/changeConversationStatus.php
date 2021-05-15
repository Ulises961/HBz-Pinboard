<?php
include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];
$user = $_REQUEST["user"];

try {
    $dbh = new PDO($conn_string);

    $update = "UPDATE PartecipatesInConversation "
              ."SET blocked = (NOT blocked) "
              ."WHERE users = :user AND conversation = :conversation";

    $query = $dbh -> prepare($update);

    $query-> bindParam(':user', $user, PDO::PARAM_INT);
    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

} catch (Exception $e) {
  echo"error: $e";
}

?>