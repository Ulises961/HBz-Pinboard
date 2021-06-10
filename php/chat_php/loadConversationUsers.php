<?php
include "../credentials.php";
include "./components/menuUserRow.php";

$conversation = $_REQUEST["conversation"];

try {
  $dbh = new PDO($conn_string);

  $sql = "SELECT id, name, surname, P.isAdmin FROM Users U ". 
         "JOIN PartecipatesInConversation P ". 
         "ON P.users = U.id AND P.conversation = :conversation";

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':conversation', $conversation, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0){
    $isCurrentUserAdmin = false;
    $conversationUser = array();
    
    while($user = $query->fetch()){
      array_push($conversationUser, $user);

      if($user["id"] == $_SESSION["user_id"] && $user["isadmin"])
        $isCurrentUserAdmin = true;
    }

    foreach($conversationUser as $user)
      createMenuUserRow($user, $isCurrentUserAdmin);
  }
    

} catch (Exception $e) {
  echo $e;
}
?>