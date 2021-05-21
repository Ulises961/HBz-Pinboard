<?php

include "chat_credentials.php";

if(isset($_REQUEST["startConversationWithUser"])){

    $user_a = $_SESSION["user_id"];
    $user_b = $_REQUEST["startConversationWithUser"];

    $dbh = new PDO($conn_string);
    $date = date("d/m/y");

    $createConversationSQL = "INSERT INTO PrivateConversation ". 
                             "VALUES(default, :conversationName, :date, '', :userA, :userB, false)";

    $query = $dbh->prepare($createConversationSQL);

    $query->bindParam(":conversationName", "this is a test name", PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->bindParam(":userA", $user_a, PDO::PARAM_STR);
    $query->bindParam(":userB", $user_b, PDO::PARAM_STR);
    $query->execute();

}

?>