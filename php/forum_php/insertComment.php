<?php
include "../credentials.php";
include "components/comment.php";

try {

$data = json_decode(file_get_contents("php://input"));

$post = $data -> question;
$comment = $data -> comment;
$user = $_SESSION["user_id"];
$date = date("d/m/y");
$time = date("H:i:s");


  $comment = filter_var($comment,FILTER_SANITIZE_STRING);
  $post = filter_var($post,FILTER_SANITIZE_NUMBER_INT);
  


  $dbh = new PDO($conn_string);

  $insert_into = "INSERT INTO Comment(id, date, time, text, users, post) ";
  $values = "VALUES(default, :date, :time, :comment, :user, :post) RETURNING *";
  $sql = $insert_into.$values;

  $insert = $dbh-> prepare($sql);

  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":comment", $comment, PDO::PARAM_STR);
  $insert-> bindParam(":user", $user, PDO::PARAM_INT);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert-> execute();
  
  $comment = $insert->fetch(PDO::FETCH_ASSOC);

  $select = "SELECT name from Users where id = :user";

  $sql = $dbh -> prepare($select);
  $sql ->bindParam(":user",$user);
  $sql -> execute();

  $name = $sql->fetch(PDO::FETCH_ASSOC);
  $comment = array_merge($name, $comment);
  createComment($comment);

} catch (Exception $e) {
 
  header("Location: Login.php");
}
?>