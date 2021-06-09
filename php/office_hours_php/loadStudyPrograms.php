<?php 
include "../credentials.php";
include "components/StudyProgramOption.php";

$dbh = new PDO($conn_string);

$faculty = $_REQUEST["faculty"];

$select = "SELECT name, code
           FROM Program 
            WHERE faculty = :facultyCode" ;
$query = $dbh->prepare($select);
$query->bindParam(":facultyCode", $faculty, PDO::PARAM_INT);
$query->execute();

while($studyProgram = $query->fetch())
    createStudyOption($studyProgram);

?>