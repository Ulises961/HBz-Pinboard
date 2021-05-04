<?php

include_once "profile_credentials.php";
include_once "getStudentProgram.php";
include_once "getProfessorSubjects.php";

$user = null;

try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT * FROM Users WHERE id = :userid";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("userid", $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> execute();


    if($query->rowCount() == 1){
        $user = $query->fetch();

        // THE FOLLOWING LINES ARE COMMENTED SINCE THE DATABASE IN USE IS NOT THE COMMPLETE ONE
        // AND THEREFORE DOES NOT HAVE THE TABLES CONCERNING STUDENTS AND PROFESSORS
        // THESE LINES MUST BE UNCOMMENTED ONCE WE START USING THE FINAL DATABASE

        // $user["job"] = getStudentProgram($_SESSION["user_id"]);

        // if($user["job"] == null)
        //     $user["job"] = getProfessorSubjects($_SESSION["user_id"]);

    }else
        echo "// REDIRECT TO 404 PAGE"; // REDIRECT TO 404 PAGE

} catch (Exception $e) {
    echo $e;
}

?>