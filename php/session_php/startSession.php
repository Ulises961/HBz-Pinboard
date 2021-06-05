<?php

function startSession($user, $dbh){  
    $date = date("d/m/y");
    $time = date("H:i:s");

    $startSession = "INSERT INTO Session ".
                    "VALUES (default, :startDate, :startTime, null, :user)";

    $query = $dbh->prepare($startSession);
    
    $query->bindParam(':startDate', $date, PDO::PARAM_STR);
    $query->bindParam(':startTime', $time, PDO::PARAM_STR);
    $query->bindParam(':user', $user, PDO::PARAM_INT);

    $query->execute();
}
    
?>