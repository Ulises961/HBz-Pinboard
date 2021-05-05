<?php

include "forum_credentials.php";
include_once "components/comment.php";

$dbh = new PDO($conn_string);
$post = $id;

$sql = "SELECT * FROM Comment WHERE post = :post";

$query = $dbh-> prepare($sql);

$query-> bindParam(":post", $post, PDO::PARAM_INT);
$query-> execute();

while ($comment = $query->fetch())
    createComment($comment);

?>