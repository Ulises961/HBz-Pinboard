<?php

include "profile_credentials.php";
include "components/askedQuestion.php";


try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT * FROM POST p JOIN Question q ON p.id = q.id AND p.users = :user";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("user", $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> execute();

    $user = null;

    if($query->rowCount() > 0){
        while($askedQuestion = $query->fetch())
            createAskedQuestion($askedQuestion);
    }else
        echo "No question asked";

} catch (Exception $e) {
    echo $e;
}

?>