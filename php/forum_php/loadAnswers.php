<?php

include "forum_credentials.php";
include "components/answer.php";

$dbh = new PDO($conn_string);
$question = $_REQUEST["question"];

$sql = "SELECT * FROM Post p JOIN Answer a ON p.id = a.id AND a.question = :question";

$query = $dbh-> prepare($sql);

$query-> bindParam(":question", $question, PDO::PARAM_INT);
$query-> execute();

while ($answer = $query->fetch())
    createAnswer($answer);

?>