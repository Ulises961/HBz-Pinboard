<?php 

include "forum_credentials.php";

try {


$id = $_REQUEST["id"];

  $dbh = new PDO($conn_string);
  $select_from = "SELECT * FROM Post P";
  $where = " WHERE P.id = :id AND NOT EXISTS ( SELECT * FROM Answer A WHERE P.id = A.id )";
  
  $sql = $select_from.$where;
  $query = $dbh -> prepare($sql);

  $query-> bindParam(":id", $id, PDO::PARAM_INT);
  $query-> execute();

  $post = $query -> fetchAll(PDO::FETCH_ASSOC);

  if (count($post) < 1)
    throw new Exception();

  createPost($post[0], false);


} catch (Exception $e) {
  http_response_code(404);
  header("Location: forum.php");
  // provide your own HTML for the error page
  die();

}

?>
