<?php
include "../credentials.php";

$conversation = $_REQUEST["conversation"];
$user = $_REQUEST["user"];

try {
    $dbh = new PDO($conn_string);

    $update = "UPDATE PartecipatesInConversation "
              ."SET isAdmin = true "
              ."WHERE conversation = :conversation AND users = :user";
         
    $query = $dbh -> prepare($update);

    $query-> bindParam(':user', $user, PDO::PARAM_INT);
    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

} catch (Exception $e) {
  echo"error: $e";
}

?>