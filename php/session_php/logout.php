<?php

session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true]);
// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

header("Location: ../../Login.php");
die();


?>