<?php 
include "officeHoursCredentials.php";
include "components/coursesOption.php";

$dbh = new PDO($conn_string);


$select = "SELECT * 
           FROM Subject";
$query = $dbh->prepare($select);
$query->execute();

while($course = $query->fetch())
    createCourseOption($course);