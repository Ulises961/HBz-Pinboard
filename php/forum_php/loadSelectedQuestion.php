<?php 

include "forum_credentials.php";
include "components/question.php";
include __DIR__."/../Utils.php";

try {


  $id = $_REQUEST["id"];


  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM Post P JOIN Users u ON p.users = u.id";
  $where = " WHERE P.id = :id AND NOT EXISTS ( SELECT * FROM Answer A WHERE P.id = A.id )";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $post = $query -> fetch(PDO::FETCH_ASSOC);

  if (count($post) < 1)
    throw new Exception();

  $link = ["link" => "Question.php?id=".$post['id']];
   
  $post = array_merge($post,$link);

  createQuestion($post);

} catch (Exception $e) {
  alert($e->getMessage());
  header("Location: Forum.php");
  // provide your own HTML for the error page
  die();

}


?>
