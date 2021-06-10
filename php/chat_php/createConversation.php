<?php

include "../credentials.php";

if(isset($_REQUEST["groupName"])){

    $conversationName = $_REQUEST["groupName"];
    $dbh = new PDO($conn_string);
    $date = date("d/m/y");
    $isAdmin = true; //the user who creates the group is the default admin

    $createConversationSQL = "INSERT INTO Conversation ". 
                             "VALUES(default, :conversationName, :date, 'conversation created')";

    $query = $dbh->prepare($createConversationSQL);

    $query->bindParam(":conversationName", $conversationName, PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->execute();

    $newConversation = $dbh->lastInsertId();

    $sql = "INSERT INTO PartecipatesInConversation VALUES(:conversation, :user, :isAdmin);";
    
    $query = $dbh -> prepare($sql);

    $query-> bindParam(':conversation', $newConversation, PDO::PARAM_INT);
    $query-> bindParam(':user', $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL); 
    $query-> execute();

    echo "success";
}

?>