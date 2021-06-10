<?php
include "../credentials.php";

$conversation = $_REQUEST["conversation"];
$user = $_SESSION["user_id"];

try {
    $dbh = new PDO($conn_string);

    $update = "DELETE FROM PartecipatesInConversation ".
              "WHERE users = :user AND conversation = :conversation";

    $query = $dbh -> prepare($update);

    $query-> bindParam(':user', $user, PDO::PARAM_INT);
    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

} catch (Exception $e) {
  echo"error: $e";
}

?>