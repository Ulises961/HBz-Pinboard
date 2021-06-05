<?php

include "../registration_php/credentials.php";

include "closeSession.php";

session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true]);
// remove all session variables
$dbh = new PDO($conn_string);

closeSession($_SESSION["user_id"], $dbh);

session_unset();

// destroy the session
session_destroy(); 

header("Location: ../../Login.php");
die();


?>