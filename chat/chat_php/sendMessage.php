<?php
include "chat_credentials.php";

$conversation = $_REQUEST["conversation"];
$message = $_REQUEST["message"];
$sender = $_REQUEST["user"];
$date = date("d/m/y");
$time = date("H:i:s");

try {
  $dbh = new PDO($conn_string);

  $insert_into = "INSERT INTO SendsMessageTo(id, date, time, text, users, conversation) ";
  $values = "VALUES(default, :date, :time, :message, :sender, :conversation)";
  $sql = $insert_into.$values;

  $insert = $dbh-> prepare($sql);

  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":message", $message, PDO::PARAM_STR);
  $insert-> bindParam(":sender", $sender, PDO::PARAM_INT);
  $insert-> bindParam(":conversation", $conversation, PDO::PARAM_INT);
  $insert->execute();

} catch (Exeception $e) {
  echo"error: $e";
}
?>