<?php



function closeSession($user, $dbh){
    
    $date = date("d/m/y");
    $time = date("H:i:s");

    $closeSession = "UPDATE Session ".
                    "SET end_time = :endTime ". 
                    "WHERE end_time ISNULL AND users = :user";

    $query = $dbh->prepare($closeSession);
    
    $query->bindParam(':endTime', $time, PDO::PARAM_STR);
    $query->bindParam(':user', $user, PDO::PARAM_INT);

    $query->execute();
}
    
?>