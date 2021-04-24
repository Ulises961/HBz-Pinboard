<?php 

include "forum_credentials.php";

try {

$id = $_REQUEST["id"];

  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM Post";
  $where = " WHERE id = :id";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $post = $query -> fetchAll(PDO::FETCH_ASSOC);

  createPost($post[0], false);


} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>
