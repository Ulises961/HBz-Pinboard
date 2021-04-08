<?php

include "forum_credentials.php";
include "components/question.php";

$dbh = new PDO($conn_string);

$sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";

$query = $dbh-> prepare($sql);
$query-> execute();

while ($question = $query->fetch())
    createQuestion($question);

?>