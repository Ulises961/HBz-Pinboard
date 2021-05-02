<?php

include "forum_credentials.php";
include "components/question.php";
include "tag.php";

$dbh = new PDO($conn_string);

$sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";

$query = $dbh-> prepare($sql);
$query-> execute();

while ($question = $query->fetch()){
    $tags= findAllTags($question["id"]);
    createQuestion($question, $tags);
}
?>