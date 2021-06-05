<?php

include "contact_credentials.php";



$dbh = new PDO($conn_string);

$select =  "SELECT * FROM Users ORDER BY(id) ASC";


$query = $dbh ->prepare($select);
$query -> execute(); 

$results= $query ->fetchAll(PDO::FETCH_ASSOC);
    
$_SESSION["current_set"]= 10;
$_SESSION["contacts"] = serialize($results);

include "indexer.php";
       

?>

