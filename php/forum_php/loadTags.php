<?php
include "components/tag.php";

function findTagId($tagContent){
include "forum_credentials.php";

$dbh = new PDO($conn_string);


$sql = "SELECT * FROM Tag WHERE name=:input";

$query = $dbh-> prepare($sql);
$query->bindParam(":input", $tagContent, PDO::PARAM_INT);
$query-> execute();

$tag = $query-> fetch(PDO::FETCH_ASSOC);

if (count($tag) < 1 )
    
    return -1;

return $tag["id"];

}

function findAllTags($question){

    include "forum_credentials.php";

    $dbh = new PDO($conn_string);
    
    $select =  "SELECT tag,post,name ";
    $from = " FROM Question q JOIN HasTag H ON q.id=H.post JOIN Tag T ON T.id=H.tag ";
    $where =  "WHERE q.id=:question;";

    $sql = $select.$from.$where;

    $query = $dbh-> prepare($sql);
    $query->bindParam(":question", $question, PDO::PARAM_INT);
    $query-> execute();
    
    $tags = $query-> fetchAll(PDO::FETCH_ASSOC);
  
    return $tags;
    
}



?>