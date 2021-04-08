<?php
include "forum_credentials.php";

$user  = $_REQUEST["user"];
$post = $_REQUEST["post"];
$vote = $_REQUEST["vote"];
$date  = date("d/m/y");
$time  = date("H:i:s");

try {
  $dbh = new PDO($conn_string);

  $insert_into = "INSERT INTO Vote(id, date, time, value, users, post) ";
  $values = "VALUES(default, :date, :time, :vote, :user, :post)";
  $sql = $insert_into.$values;

  $insert = $dbh-> prepare($sql);

  $insert-> bindParam(":user", $user, PDO::PARAM_INT);
  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":vote", $title, PDO::PARAM_INT);
  $insert-> bindParam(":post", $text, PDO::PARAM_INT);
  $insert->execute();

} catch (Exeception $e) {
  echo"error: $e";
}
?>