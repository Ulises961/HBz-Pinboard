
<?php
    include_once "../credentials.php";

    if(isset($_REQUEST["conversation"])){
        
        $dbh = new PDO($conn_string);

        $getPrivateConversation = "SELECT wasBlockedBy, blocked FROM PrivateConversation WHERE id = :conversation";
        $query = $dbh->prepare($getPrivateConversation);

        $query->bindParam(":conversation", $_REQUEST["conversation"], PDO::PARAM_INT);
        $query->execute();
        
        $privateConversation = $query->fetch();
        $chatIsBlocked = $privateConversation["blocked"];
        $chatWasBlockedBy = $privateConversation["wasblockedby"];

        if($chatIsBlocked && $chatWasBlockedBy != $_SESSION["user_id"])
            echo "<p>You have been blocked</p>";
        elseif($chatIsBlocked && $chatWasBlockedBy == $_SESSION["user_id"])
            echo "<button class='btn btn-danger' onclick='blockConversation()'>Unblock User</button>";
        else
            echo "<button class='btn btn-info' onclick='blockConversation()'>Block User</button>";
    }

?>

