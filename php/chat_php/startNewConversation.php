<?php

include "chat_credentials.php";

if(isset($_REQUEST["startConversationWithUser"])){

    $newConversationUsers = array(
        $_SESSION["user_id"],
        $_REQUEST["startConversationWithUser"]
    );

    $dbh = new PDO($conn_string);
    $date = date("d/m/y");

    $dbh->beginTransaction();

    $createConversationSQL = "INSERT INTO Conversation VALUES(default, :conversationName, :date, '')";
    $query = $dbh->prepare($createConversationSQL);

    $query->bindParam(":conversationName", $conversationName, PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->execute();

    $conversation = $dbh->lastInsertId();

    foreach($newConversationUsers as $newUser) {
        $sql = "INSERT INTO PartecipatesInConversation VALUES(:conversation, :user, false);";
        $query = $dbh->prepare($sql);

        $query->bindParam(':conversation', $conversation, PDO::PARAM_INT);
        $query->bindParam(':user', $newUser, PDO::PARAM_INT);
        $query->execute();
    }

    $dbh->rollBack();
}

?>