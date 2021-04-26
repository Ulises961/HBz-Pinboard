<?php

include "forum_credentials.php";

$post_id = $_REQUEST["post"];
$dbh = new PDO($conn_string);

$sql = "SELECT * FROM Post WHERE id = :post";

$query = $dbh-> prepare($sql);
$query-> bindParam(":post", $post_id, PDO::PARAM_INT);
$query-> execute();

while($post = $query->fetch())
    echo $post["votes"];

?>