<?php

include "php/credentials.php";
include "components/givenAnswer.php";

$user = $_SESSION["user_id"];

if(isset($_REQUEST["user"]) && $_REQUEST["user"] != $_SESSION["user_id"])
    $user = $_REQUEST["user"];

try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT p1.id, p1.title ".
           "FROM Post p1 ".
           "JOIN Question q ON q.id = p1.id ".
           "JOIN Answer a ON a.question_id = q.id ".
           "JOIN Post p2 ON p2.id = a.id AND p2.users = :user";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("user", $user, PDO::PARAM_INT);
    $query-> execute();

    if($query->rowCount() > 0){
        while($givenAnswer = $query->fetch())
            createGivenAnswer($givenAnswer);
    }else
        echo "No answer given";

} catch (Exception $e) {
    echo $e;
}

?>