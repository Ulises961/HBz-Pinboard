<?php

include "forum_credentials.php";
include "components/answer.php";

$dbh = new PDO($conn_string);
$question = $_REQUEST["id"];
$answer;
$sql = "SELECT * FROM Post p JOIN Answer a ON p.id = a.id AND a.question_id = :question";

$query = $dbh-> prepare($sql);

$query-> bindParam(":question", $question, PDO::PARAM_INT);
$query-> execute();

while ($answer = $query->fetch()){
   
    //located in component/answer.php
    createAnswer($answer);
   

}
?>

