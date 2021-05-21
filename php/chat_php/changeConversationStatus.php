<?php
include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];

try {
    $dbh = new PDO($conn_string);

    $update = "UPDATE PrivateCoversation "
              ."SET blocked = (NOT blocked) "
              ."WHERE conversation = :conversation";

    $query = $dbh -> prepare($update);

    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

} catch (Exception $e) {
  echo"error: $e";
}

?>