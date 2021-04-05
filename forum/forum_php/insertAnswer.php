<?php
include "forum_credentials.php";

$post = $_REQUEST["post"];
$question = $_REQUEST["question"];

try {
  $dbh = new PDO($conn_string);

  $sql = "INSERT INTO Answer(id, question) VALUES(:post, :question)";

  $insert = $dbh-> prepare($sql);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert-> bindParam(":question", $question, PDO::PARAM_INT);
  $insert->execute();

} catch (Exeception $e) {
  echo"error: $e";
}
?>