<?php
include "forum_credentials.php";

$post = $_REQUEST["post"];
$comment = $_REQUEST["comment"];
$user = $_REQUEST["user"];
$date = date("d/m/y");
$time = date("H:i:s");

try {
  $dbh = new PDO($conn_string);

  $insert_into = "INSERT INTO Comment(id, date, time, text, users, post) ";
  $values = "VALUES(default, :date, :time, :comment, :user, :post)";
  $sql = $insert_into.$values;

  $insert = $dbh-> prepare($sql);

  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":comment", $comment, PDO::PARAM_STR);
  $insert-> bindParam(":user", $user, PDO::PARAM_INT);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert->execute();

} catch (Exception $e) {
  echo"error: $e";
}
?>