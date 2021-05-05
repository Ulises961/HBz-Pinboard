<?php 
include "officeHoursCredentials.php";
include "components/StudyProgramOption.php";

$dbh = new PDO($conn_string);

$faculty = $_REQUEST["faculty"];

$select = "SELECT * 
           FROM Program 
           JOIN Faculty ON Faculty.code = Program.faculty AND faculty.code = :facultyCode" ;
$query = $dbh->prepare($select);
$query->bindParam("facultyCode", $faculty, PDO::PARAM_INT);
$query->execute();

while($studyProgram = $query->fetch())
    createStudyOption($studyProgram);