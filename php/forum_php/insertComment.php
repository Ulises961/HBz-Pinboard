<?php
include "forum_credentials.php";
include "components/comment.php";

$data = json_decode(file_get_contents("php://input"));

$post = $data -> question;
$comment = $data -> comment;
$user = $_SESSION["user_id"];
$date = date("d/m/y");
$time = date("H:i:s");

try {
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

  createComment($comment);

} catch (Exception $e) {
  echo"s<script>alert('$e');</script>";
}
?>