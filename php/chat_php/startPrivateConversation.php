<?php

include "chat_credentials.php";

if(isset($_REQUEST["startConversationWithUser"])){

    $_SESSION["user_id"] = 1;
    $user_a = $_SESSION["user_id"];
    $user_b = $_REQUEST["startConversationWithUser"];
    $conversationName = "this is a test name";
    $dbh = new PDO($conn_string);
    $date = date("d/m/y");

    $createConversationSQL = "INSERT INTO PrivateConversation ". 
                             "VALUES(default, :conversationName, :date, 'baseMessage', :userA, :userB, false, NULL)";

    $query = $dbh->prepare($createConversationSQL);

    $query->bindParam(":conversationName", $conversationName, PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->bindParam(":userA", $user_a, PDO::PARAM_INT);
    $query->bindParam(":userB", $user_b, PDO::PARAM_INT);
    $query->execute();

}

?>