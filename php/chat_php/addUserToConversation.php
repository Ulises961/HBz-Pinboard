<?php

include "chat_credentials.php";
include "components/userListItem.php";

$conversation = $_REQUEST["conversation"];
$user = $_REQUEST["user"];

try {
    $dbh = new PDO($conn_string);
    $select_from = "SELECT * FROM users ";
    $where = "WHERE conversation = :conversation ORDER BY date ASC, time ASC";

    $sql = $select_from.$where;
    $query = $dbh -> prepare($sql);

    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> execute();

    $messages = array();

    while ($message = $query->fetch())
        createIncomingMessage($message);


} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>