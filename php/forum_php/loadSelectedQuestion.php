<?php 

include "forum_credentials.php";
include "components/question.php";
include __DIR__."/../Utils.php";

try {
  if (session_status() == PHP_SESSION_NONE) {
    header("Location: ./../../Login.php");
}

  $id = $_REQUEST["id"];


  $dbh = new PDO($conn_string);
  $select = "SELECT p.id AS id, p.date AS date, p.time AS time, p.title AS title, u.name AS name,  p.votes AS votes ,p.text AS text";
  $from = " FROM Post P JOIN Users u ON p.users = u.id";
  $where = " WHERE P.id = :id AND NOT EXISTS ( SELECT * FROM Answer A WHERE P.id = A.id )";
  
  $sql = $select.$from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $post = $query -> fetch(PDO::FETCH_ASSOC);

  if (count($post) < 1)
    throw new Exception();

  createQuestion($post);

} catch (Exception $e) {
  
  $_SESSION["message"]= $e->getMessage();
   
  header("Location: Forum.php");
  // provide your own HTML for the error page
  die();

}


?>
