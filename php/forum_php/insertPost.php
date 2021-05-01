<?php

include __DIR__."/forum_credentials.php";
include __DIR__."/insertAnswer.php";
include __DIR__."/components/post.php";

$data = json_decode(file_get_contents("php://input"));

  $user  = $data-> user;
  $date  = date("d/m/y");
  $time  = date("H:i:s");
  $title = $data-> title;
  $text  = $data-> text;
  $question = $data -> questionId;
  $postId;
  $post;
  try {
    $dbh = new PDO($conn_string);
    if ($text ==="" || $text ==="<p><br></p>" || $text ==="<p><br data-mce-bogus='1'></p>")
      throw new Exception();
    $insert_into = "INSERT INTO Post(id, users, date, time, title, text, votes) ";
    $values = "VALUES(default, :user, :date, :time, :title, :text, 0) RETURNING *";
    $sql = $insert_into.$values;

    $insert = $dbh-> prepare($sql);

    $insert-> bindParam(":user", $user, PDO::PARAM_INT);
    $insert-> bindParam(":date", $date, PDO::PARAM_STR);
    $insert-> bindParam(":time", $time, PDO::PARAM_STR);
    $insert-> bindParam(":title", $title, PDO::PARAM_STR);
    $insert-> bindParam(":text", $text, PDO::PARAM_STR);
    $insert->execute();
  
    $post = $insert->fetch(PDO::FETCH_ASSOC);
 

  } catch (Exception $e) {
    echo"error: $e";
  }
  if($question != ""){
   
    insertAnswer($post["id"], $question);
    echo "<script> alert('doing something');</script>";
    createAnswer($post);
  
}
?>