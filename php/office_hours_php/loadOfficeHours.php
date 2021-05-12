<?php
include "./officeHoursCredentials.php";
include "./components/professorsOfficeHours.php";

$course = $_REQUEST["course"];

$dbh = new PDO($conn_string);
$select = "SELECT *                                                                                   
           FROM users U JOIN Professor P ON U.id = P.id JOIN Teaches T ON T.professor = P.id
           WHERE T.subject = :course";

$query = $dbh -> prepare($select);
$query -> bindParam(":course", $course, PDO::PARAM_INT);
$query -> execute();

while($professor = $query->fetch(PDO::FETCH_ASSOC))
    createProfessorsOfficeHours($professor);
?>