<?php
include "forum_credentials.php";

$post = $_REQUEST["post"];

try {
  $dbh = new PDO($conn_string);

  $sql = "INSERT INTO Comment(id) VALUES(:post)";

  $insert = $dbh-> prepare($sql);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert->execute();

} catch (Exeception $e) {
  echo"error: $e";
}
?>