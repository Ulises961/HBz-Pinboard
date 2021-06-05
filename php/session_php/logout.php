<?php

include "../credentials.php";

include "closeSession.php";

// remove all session variables

$dbh = new PDO($conn_string);

closeSession($_SESSION["user_id"], $dbh);

session_unset();

// destroy the session
session_destroy(); 

header("Location: ../../Login.php");
die();


?>