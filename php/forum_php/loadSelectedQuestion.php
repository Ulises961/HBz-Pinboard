<?php 

include "forum_credentials.php";
include "components/question.php";
include __DIR__."/../Utils.php";

try {


  $id = $_REQUEST["id"];


  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM Post P";
  $where = " WHERE P.id = :id AND NOT EXISTS ( SELECT * FROM Answer A WHERE P.id = A.id )";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $post = $query -> fetch(PDO::FETCH_ASSOC);

  if (count($post) < 1)
    throw new Exception();

  $class = ["class" => ""];
   
  $post = array_merge($post,$class);

  createQuestionToBeAnswered($post, true);



} catch (Exception $e) {
  alert($e);
  header("Location: forum.php");
  // provide your own HTML for the error page
  die();

}


?>
