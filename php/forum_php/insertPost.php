<?php
include "forum_credentials.php";
include "insertAnswer.php";

$data = json_decode(file_get_contents("php://input"));

  $user  = $data-> user;
  $date  = date("d/m/y");
  $time  = date("H:i:s");
  $title = $data-> title;
  $text  = $data-> text;
  $question = $data -> questionId;
  $postId;
  try {
    $dbh = new PDO($conn_string);

    $insert_into = "INSERT INTO Post(id, users, date, time, title, text) ";
    $values = "VALUES(default, :user, :date, :time, :title, :text)";
    $sql = $insert_into.$values;

    $insert = $dbh-> prepare($sql);

    $insert-> bindParam(":user", $user, PDO::PARAM_INT);
    $insert-> bindParam(":date", $date, PDO::PARAM_STR);
    $insert-> bindParam(":time", $time, PDO::PARAM_STR);
    $insert-> bindParam(":title", $title, PDO::PARAM_STR);
    $insert-> bindParam(":text", $text, PDO::PARAM_STR);
    $insert->execute();
    $postId= $dbh->lastInsertId();
  } catch (Exception $e) {
    echo"error: $e";
  }

  if($question != ""){
   
    $sucess = insertAnswer($postId, $question);
    echo $text;
  }
?>