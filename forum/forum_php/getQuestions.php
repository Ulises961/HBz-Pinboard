<?php

include "forum_credentials.php";

$dbh = new PDO($conn_string);

$sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";

$query = $dbh-> prepare($sql);
$query-> execute();

while ($row = $query->fetch())
    echo implode($row);

?>