
<?php


// Connecting, selecting database

include "credentials.php";

$dbh = new PDO($conn_string);

// Performing SQL query
$query = 'SELECT name FROM Program';

$results=[];
$result = $dbh->query($query);

$rows = $result -> fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $line){
    $results[] = $line; 

}

$json = json_encode($results);

echo "$json";


?> 

