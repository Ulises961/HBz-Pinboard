<?php

include "../credentials.php";

if(isset($_REQUEST["groupName"])){

    $_SESSION["user_id"] = 1;
    $conversationName = $_REQUEST["groupName"];

    $dbh = new PDO($conn_string);
    $date = date("d/m/y");

    $createConversationSQL = "INSERT INTO Conversation ". 
                             "VALUES(default, :conversationName, :date, 'conversation created')";

    $query = $dbh->prepare($createConversationSQL);

    $query->bindParam(":conversationName", $conversationName, PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->execute();

    $newConversation = $dbh->lastInsertId();

    $sql = "INSERT INTO PartecipatesInConversation VALUES(:conversation, :user);";

    $query = $dbh -> prepare($sql);

    $query-> bindParam(':conversation', $newConversation, PDO::PARAM_INT);
    $query-> bindParam(':user', $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> execute();

    echo "success";
}

?>