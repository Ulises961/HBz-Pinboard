<?php

include "contact_credentials.php";
include "components/ContactRow.php";

$dbh = new PDO($conn_string);

$select =  "SELECT * FROM Users";


$query = $dbh ->prepare($select);
$query -> execute(); 

while($user = $query->fetch()){
    createContactRow($user);
}

?>

