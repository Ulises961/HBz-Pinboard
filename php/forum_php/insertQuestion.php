<?php
include "forum_credentials.php";

$post = $_REQUEST["post"];

try {
  $dbh = new PDO($conn_string);

  $sql = "INSERT INTO Question(id) VALUES(:post)";

  $insert = $dbh-> prepare($sql);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert->execute();

} catch (Exception $e) {
  echo"error: $e";
}
?>