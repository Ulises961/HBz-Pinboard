<?php
$host = "localhost";
$dbname = "hbz";
$dbuser = "postgres";
$port = "5432";
$password = "postgres";

$conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$dbuser password=$password";



if(session_status() == PHP_SESSION_NONE)
session_start(['cookie_lifetime' => 43200,'cookie_secure' => false,'cookie_httponly' => true, 'cookie_samesite'=>'Strict']); 
?>

