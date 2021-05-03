<?php

$tag = "";

if(isset($_GET["tag"] ))
    $tag = $_GET["tag"];

include "forum_credentials.php";
include "components/question.php";
include "tag.php";


$dbh = new PDO($conn_string);
$query;

if($tag !== ""){    
    
    $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id JOIN HasTag h ON p.id=h.post WHERE h.tag=:tag";
    $query = $dbh-> prepare($sql);
    $query -> bindParam(":tag", $tag,PDO::PARAM_INT); 
}else{ 
    $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";
    $query = $dbh-> prepare($sql);

}

$query-> execute();

while ($question = $query->fetch()){
    $tags= findAllTags($question["id"]);
    createQuestion($question, $tags);
}

?>