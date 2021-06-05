<?php
include "../credentials.php";

$isConversationPrivate = $_REQUEST["isPrivate"];
$conversation = $_REQUEST["conversation"];
$message = $_REQUEST["message"];
$sender = $_SESSION["user_id"];

$date = date("d/m/y");
$time = date("H:i:s");

try {

  $conversation = filter_var($conversation,FILTER_SANITIZE_STRING);
  $message = filter_var($message,FILTER_SANITIZE_STRING);
  
  $dbh = new PDO($conn_string);

  $table = "SendsMessageTo";
  
  if($isConversationPrivate == 1)
    $table = "PrivateMessageTo";

  $sendMessage = "INSERT INTO $table VALUES(default, :date, :time, :message, :sender, :conversation)";
  echo "INSERT INTO $table VALUES(default, '$date', '$time', '$message', $sender, $conversation)";
  $insert = $dbh-> prepare($sendMessage);

  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":message", $message, PDO::PARAM_STR);
  $insert-> bindParam(":sender", $sender, PDO::PARAM_INT);
  $insert-> bindParam(":conversation", $conversation, PDO::PARAM_INT);
  $insert->execute();

} catch (Exception $e) {
  echo"error: $e";
}
?>