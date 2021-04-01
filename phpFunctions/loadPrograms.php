
<?php

// Connecting, selecting database

$host        = "host = localhost";
$port        = "port = 5432";
$dbname      = "dbname = hbz";
$credentials = "user = postgres password=postgres";


$dbconn = pg_connect("$host $port $dbname $credentials ")
    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
$query = 'SELECT name FROM Program';
$result = pg_query($dbconn, $query);

if(!$result) {
    echo pg_last_error($dbconn);
    exit;
 } 
// Printing results in HTML

while($line = pg_fetch_row ($result)){

    $results[] = $line; 
}

$json = json_encode($results);

echo $json;
// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);


?> 
