<?php

include __DIR__."/forum_credentials.php";
include __DIR__."/insertAnswer.php";
include __DIR__."/components/answer.php";


session_start();

$data = json_decode(file_get_contents("php://input"));

if ($data !== NULL){

  $title = $data-> title;
  $text  = $data-> text;
  $questionId = $data -> questionId;

  

}else{
  $title = $_REQUEST["title"];
  $text  = $_REQUEST["text"];
  $tags= $_REQUEST["tags"];
  $tags = filter_var($tags,FILTER_SANITIZE_STRING);
}

$date  = date("d/m/y");
$time  = date("H:i:s");
$user  = $_SESSION["user_id"];
$postId;
$post;
try {

  $title = filter_var($title,FILTER_SANITIZE_STRING);
  $text = filter_var($text,FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_AMP);


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
  echo"error:". $e->getMessage();
}

if(isset($questionId) && $questionId != ""){

  insertAnswer($post["id"], $questionId);
  createAnswer($post);

}else{
  $sql = "INSERT INTO Question(id) VALUES(:post)";
  $insert = $dbh->prepare($sql);
  $insert->bindParam(":post", $post["id"], PDO::PARAM_INT);
  $insert->execute();

  if($tags !== ""){
    include "insertTag.php";
  }
  header("Location: ./../../Question.php?id=".$post["id"]);
}
?>