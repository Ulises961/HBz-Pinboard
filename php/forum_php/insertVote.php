<?php

if(file_exists("php/credentials.php"))
 include "php/credentials.php";
else
 include "../credentials.php";

$data = json_decode(file_get_contents("php://input"));
$post = $data -> id;
$vote = $data -> value;
$user = $_SESSION["user_id"];

$date  = date("d/m/y");
$time  = date("H:i:s");

try {
  
  $dbh = new PDO($conn_string);
  $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

  $insert_into = "INSERT INTO Vote(id, date, time, value, users, post) ";
  $values = "VALUES(default, :date, :time, :vote, :user, :post) RETURNING *";
  $sql = $insert_into.$values;
  var_dump( $user);
  $insert = $dbh-> prepare($sql);
 
  $insert-> bindParam(":user", $user, PDO::PARAM_INT);
  $insert-> bindParam(":date", $date, PDO::PARAM_STR);
  $insert-> bindParam(":time", $time, PDO::PARAM_STR);
  $insert-> bindParam(":vote", $vote, PDO::PARAM_INT);
  $insert-> bindParam(":post", $post, PDO::PARAM_INT);
  $insert->execute();
 



} catch (Exception $e) {
  var_dump($e);
}

?>