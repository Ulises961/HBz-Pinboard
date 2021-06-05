<?php

include "php/credentials.php";
include "components/answer.php";

$dbh = new PDO($conn_string);
$question = $_REQUEST["id"];
$answer;



$select = "SELECT p.id AS id, p.date AS date, p.time AS time, p.text AS text, u.name AS name,  p.votes AS votes, u.picture AS picture, u.id AS userid ";
$from = " FROM Post p JOIN Answer a ON p.id = a.id JOIN Users u ON p.users = u.id";
$where = "  WHERE a.question_id = :question";
$sql = $select.$from.$where;
$query = $dbh-> prepare($sql);

$query-> bindParam(":question", $question, PDO::PARAM_INT);
$query-> execute();

while ($answer = $query->fetch()){
   
    //located in component/answer.php
    createAnswer($answer);
   

}
?>

