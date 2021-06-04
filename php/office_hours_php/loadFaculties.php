<?php 
include "officeHoursCredentials.php";
include "components/facultyOptions.php";

$dbh = new PDO($conn_string);

$select = "SELECT name, code FROM Faculty";
$query = $dbh->prepare($select);
$query->execute();

while($faculty = $query->fetch())
    createFacultyOption($faculty);

?>