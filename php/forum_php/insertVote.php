<?php

  include "forum_credentials.php";
$data = json_decode(file_get_contents("php://input"));
$post = $data -> id;
$vote = $data -> value;
$user = $_SESSION["user_id"];
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
  $insert-> bindParam(":vote", $vote, PDO::PARAM_INT);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert->execute();

  echo"executed";

} catch (Exception $e) {
  echo"error: $e";
}

?>