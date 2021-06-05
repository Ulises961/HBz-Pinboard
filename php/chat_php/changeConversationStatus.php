<?php
include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];

try {
    $dbh = new PDO($conn_string);

    $update = "UPDATE PrivateConversation "
              ."SET blocked = (NOT blocked) AND wasBlockedBy = :user"
              ."WHERE id = :conversation";

    $query = $dbh -> prepare($update);

    $query-> bindParam(':user', $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

} catch (Exception $e) {
  echo"error: $e";
}

?>