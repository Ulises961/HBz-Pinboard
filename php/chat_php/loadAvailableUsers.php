<?php
include "../credentials.php";
include "components/availableUserOption.php";

$conversation = $_REQUEST["conversation"];
$search_term = "%".$_REQUEST["searchTerm"]."%"; // The % will match any character

try {
    $dbh = new PDO($conn_string);

    $sql = "SELECT U.id, U.name, U.surname ".
           "FROM Users U ". 
           "WHERE U.name LIKE :searchTerm OR U.surname LIKE :searchTerm ". 
           "EXCEPT ". 
           "SELECT U2.id, U2.name, U2.surname FROM Users U2 ".
           "INNER JOIN PartecipatesInConversation P ". 
           "ON U2.id = p.users AND p.conversation = :conversation";
    
    $query = $dbh -> prepare($sql);

    $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
    $query-> bindParam(':searchTerm', $search_term, PDO::PARAM_STR);
    $query-> execute();

    while ($user = $query->fetch())
      createAvailableUserOption($user);


} catch (Exception $e) {
  echo"error";
  echo $e;
}

?>


