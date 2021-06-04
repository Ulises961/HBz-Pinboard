<?php

function getProfessorSubjects($user_id){
    include "profile_credentials.php";

    try {
        $dbh = new PDO($conn_string);
        
        $sql = "SELECT s.name FROM Subject s JOIN Teaches t ON t.subject = s.id AND t.professor = :user";

        $query = $dbh-> prepare($sql);
        $query-> bindParam("userid", $user_id, PDO::PARAM_INT);
        $query-> execute();

        if($query->rowCount() > 1){
            $subjects = "";

            while($subject = $query->fetch())
                $subjects = $subjects.", ".$subject["name"];
            
            return $subjects;

        }else
            return null;
    } catch (Exception $e) {
        echo $e;
    }
}

?>