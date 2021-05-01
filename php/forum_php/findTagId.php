<?php

function findTagId($tagContent){
include "forum_credentials.php";

$dbh = new PDO($conn_string);


$sql = "SELECT * FROM Tag WHERE name=:input";

$query = $dbh-> prepare($sql);
$query->bindParam(":input", $tagContent, PDO::PARAM_INT);
$query-> execute();

$tag = $query-> fetchAll(PDO::FETCH_ASSOC);

if (count($tag) < 1 )
    
    return -1;

return $tag[0]["id"];

}


?>