<?php
include "forum_credentials.php";

$user  = $_REQUEST["user"];
$date  = date("d/m/y");
$time  = date("H:i:s");
$title = $_REQUEST["title"];
$text  = $_REQUEST["text"];

try {
  $dbh = new PDO($conn_string);

  $insert_into = "INSERT INTO Comment(id, users, date, time, title, text) ";
  $values = "VALUES(default, :user, :date, :time, :title, :text)";
  $sql = $insert_into.$values;

  $insert = $dbh-> prepare($sql);

  $insert-> bindParam(":user", $user, PDO::PARAM_INT);
  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":title", $title, PDO::PARAM_STR);
  $insert-> bindParam(":text", $text, PDO::PARAM_STR);
  $insert->execute();

} catch (Exeception $e) {
  echo"error: $e";
}
?>