
<?php
    include_once "../credentials.php";

    if(isset($_REQUEST["conversation"])){
        
        $dbh = new PDO($conn_string);

        $getPrivateConversation = "SELECT wasBlockedBy FROM PrivateConversation WHERE id = :conversation";
        $query = $dbh->prepare($getPrivateConversation);

        $query->bindParam(":conversation", $_REQUEST["conversation"], PDO::PARAM_INT);
        $query->execute();
        
        $privateConversation = $query->fetch();
        $chatWasBlockedBy = $privateConversation["wasblockedby"];

        if($chatWasBlockedBy != NULL && $chatWasBlockedBy != $_SESSION["user_id"])
            echo "<p>You have been blocked</p>";
        else
            echo "<button class='btn btn-info' onclick='blockConversation()'>Block User</button>";   
    }

?>

