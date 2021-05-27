<?php
include "contact_credentials.php";
include "components/ContactRow.php";

$search_term = "%".$_REQUEST["searchTerm"]."%"; // The % will match any character

try {
    $dbh = new PDO($conn_string);

    $sql = "SELECT * ".
           "FROM Users U ". 
           "WHERE U.name LIKE :searchTerm OR U.surname LIKE :searchTerm ";
    
    $query = $dbh -> prepare($sql);

    $query-> bindParam(':searchTerm', $search_term, PDO::PARAM_STR);
    $query-> execute();

      while ($user = $query->fetch())
        createContactRow($user);

} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>


