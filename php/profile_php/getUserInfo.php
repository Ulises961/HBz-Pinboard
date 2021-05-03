<?php

include "profile_credentials.php";


try {
    $dbh = new PDO($conn_string);
    
    $sql = "SELECT * FROM Users WHERE id = :userid";

    $query = $dbh-> prepare($sql);
    $query-> bindParam("userid", $_SESSION["user_id"], PDO::PARAM_INT);
    $query-> execute();

    $user = null;

    if($query->rowCount() == 1)
        $user = $query->fetch();
    else
        echo "// REDIRECT TO 404 PAGE"; // REDIRECT TO 404 PAGE

} catch (Exception $e) {
    echo $e;
}

?>