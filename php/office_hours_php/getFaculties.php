<?php 
include "officeHoursCredentials.php";
include "components/facultyOptions.php";

$dbh = new PDO($conn_string);

$select = "SELECT * FROM Faculty";
$query = $dbh->prepare($select);
$query->execute();

while($faculty = $query->fetch())
    createFacultyOption($faculty);

