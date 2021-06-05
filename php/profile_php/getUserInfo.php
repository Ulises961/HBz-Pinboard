<?php

include_once "php/credentials.php";
include_once "getStudentProgram.php";
include_once "getProfessorSubjects.php";

try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT * FROM Users WHERE id = :userid";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("userid", $user, PDO::PARAM_INT);
    $query-> execute();


    if($query->rowCount() == 1){
        $user = $query->fetch();

        // THE FOLLOWING LINES ARE COMMENTED SINCE THE DATABASE IN USE IS NOT THE COMMPLETE ONE
        // AND THEREFORE DOES NOT HAVE THE TABLES CONCERNING STUDENTS AND PROFESSORS
        // THESE LINES MUST BE UNCOMMENTED ONCE WE START USING THE FINAL DATABASE

        // $user["job"] = getStudentProgram($_SESSION["user_id"]);

        // if($user["job"] == null)
        //     $user["job"] = getProfessorSubjects($_SESSION["user_id"]);

    }else{
        header("Location:Profile.php");
    }

} catch (Exception $e) {
    echo $e;
}

?>