<?php

include "profile_credentials.php";
include "components/givenAnswer.php";


try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT * ".
           "FROM Post p1 ".
           "JOIN Question q ON q.id = p1.id ".
           "JOIN Answer a ON a.question_id = q.id ".
           "JOIN Post p2 ON p2.id = a.id AND p2.users = :user";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("user", $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> execute();

    $user = null;

    if($query->rowCount() > 0){
        while($givenAnswer = $query->fetch())
            createGivenAnswer($givenAnswer);
    }else
        echo "No answer given";

} catch (Exception $e) {
    echo $e;
}

?>