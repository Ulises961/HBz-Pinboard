<?php 

include "forum_credentials.php";


$id = $_REQUEST["post"];
$question;
try {

  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM Post";
  $where = "WHERE id = :id";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $question = $query -> fetch(PDO::FETCH_ASSOC);
  
  $questionJson = json_encode($question);

  echo $questionJson;

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>
