<?php 
include "officeHoursCredentials.php";
include "components/coursesOption.php";

$dbh = new PDO($conn_string);

$study_program = $_REQUEST["studyProgram"];

$select = "SELECT * 
           FROM Subject S JOIN taught_in T 
           ON S.id = T.subject AND T.program = :studyProgram";

$query = $dbh->prepare($select);
$query->bindParam("studyProgram", $study_program, PDO::PARAM_INT);
$query->execute();

while($course = $query->fetch())
    createCourseOption($course);
?>