<?php

include "php/credentials.php";
include_once "components/comment.php";

$dbh = new PDO($conn_string);
$post = $id;

$select = "SELECT c.id AS id, c.date AS date, c.text u.name AS name, p.votes AS votes";
$from = " FROM Comment c JOIN Users u on c.users = u.id";
$where = " WHERE post = :post";
$sql = $select.$from.$where;

$query = $dbh-> prepare($sql);

$query-> bindParam(":post", $post, PDO::PARAM_INT);
$query-> execute();

while ($comment = $query->fetch())
    createComment($comment);

?>