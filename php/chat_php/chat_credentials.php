<?php
$host = "localhost";
$dbname = "hbz";
$user = "postgres";
$port = "5432";
$password = "postgres";

$conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";

if(session_status() == PHP_SESSION_NONE)
    session_start();
?>