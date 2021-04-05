
<?php


// Connecting, selecting database

$host        = "host = localhost";
$port        = "port = 5432";
$dbname      = "dbname = hbz";
$credentials = "user = postgres password=postgres";


$dbconn = pg_connect("$host $port $dbname $credentials ")
    or die('Could not connect: ' . pg_last_error());



$mail =$_GET['mail'];


echo  "$mail";

// Creating a user

pg_prepare($dbconn, "count", 'SELECT COUNT(*) from Users WHERE mail=$1');

$result = pg_execute($dbconn,"count",array($mail));

$row = pg_fetch_row($result);

if(!$result) {
    echo pg_last_error($dbconn);
    exit;
 } else{
     echo '<p>success!</p>';
 }

echo row[0];

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);


?> 
