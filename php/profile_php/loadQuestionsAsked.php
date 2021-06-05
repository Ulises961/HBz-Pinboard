<?php

include "php/credentials.php";
include "components/askedQuestion.php";

$user = $_SESSION["user_id"];

if(isset($_REQUEST["user"]) && $_REQUEST["user"] != $_SESSION["user_id"])
    $user = $_REQUEST["user"];

try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT p.id, p.title FROM POST p JOIN Question q ON p.id = q.id AND p.users = :user";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("user", $user, PDO::PARAM_INT);
    $query-> execute();

    if($query->rowCount() > 0){
        while($askedQuestion = $query->fetch())
            createAskedQuestion($askedQuestion);
    }else
        echo "No question asked";

} catch (Exception $e) {
    echo $e;
}

?>