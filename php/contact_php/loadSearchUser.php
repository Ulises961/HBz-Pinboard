<?php
include "../credentials.php";

$search_term = "%".$_REQUEST["searchTerm"]."%"; // The % will match any character

try {
    $dbh = new PDO($conn_string);

    $sql = "SELECT * ".
           "FROM Users U ". 
           "WHERE U.name LIKE :searchTerm OR U.surname LIKE :searchTerm ";
    
    $query = $dbh -> prepare($sql);

    $query-> bindParam(':searchTerm', $search_term, PDO::PARAM_STR);
    $query-> execute();

    
    $results= $query ->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["current_set"]= 10;

    $_SESSION["contacts"] = serialize($results);
    
    
    include "indexer.php";
       

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>


