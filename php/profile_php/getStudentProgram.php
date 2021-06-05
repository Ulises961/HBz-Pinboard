<?php

function getStudentProgram($user_id){
    include "php/credentials.php";

    try {
        $dbh = new PDO($conn_string);
        
        $sql = "SELECT * FROM Program p JOIN Student s ON p.id = s.program AND s.id = :user";

        $query = $dbh-> prepare($sql);
        $query-> bindParam("userid", $user_id, PDO::PARAM_INT);
        $query-> execute();


        if($query->rowCount() > 1){
            $program = $query->fetch();
            return $program;

        }else
            return null;
    } catch (Exception $e) {
        echo $e;
    }
}
?>