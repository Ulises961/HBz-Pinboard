<?php

function insertAnswer($post,$question){

include "forum_credentials.php";

  try {
    $dbh = new PDO($conn_string);

    $sql = "INSERT INTO Answer(id, question_id) VALUES(:post, :question)";

    $insert = $dbh-> prepare($sql);
    $insert-> bindParam(":post", $post, PDO::PARAM_INT);
    $insert-> bindParam(":question", $question, PDO::PARAM_INT);
    $insert->execute();

  } catch (Exception $e) {
    echo"error: $e";
  }
}
?>