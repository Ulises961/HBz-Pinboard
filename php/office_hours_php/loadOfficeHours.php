<?php
include "./officeHoursCredentials.php";
include "/components/professorsOfficeHours.php";

$course = $_REQUEST["course"];

$dbh = new PDO($conn_string);
$select = "SELECT * 
           FROM users U, Professor P JOIN Teaches T
           ON T.professor = P.id AND T.subject = :course AND P.id = U.id";

$query = $dbh -> prepare($select);
$query -> bindParam(":course", $course, PDO::PARAM_INT);
$query -> execute();

while($professor = $query->fetch())
    createProfessorsOfficeHours($professor);
?>