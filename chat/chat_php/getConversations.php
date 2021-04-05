<?php
include "conversationElement.php";
include "chat_credentials.php";

// right now we are onlu testing and there is no session vairable set
// $user = $_SESSION["user"]; 
$user = 1; 

try {
  $dbh = new PDO($conn_string);

  $select = "SELECT id, name, last_change, last_message ";
  $from = "FROM conversation , partecipatesinconversation ";
  $where = "WHERE id = conversation AND users = :user";

  $sql =  $select.$from.$where;

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0) {

    while($row = $query->fetch()){
      // echo implode($row);
      createConversationElement(
        $row["id"],
        $row["name"],
        $row["last_change"],
        $row["last_message"],
        "https://ptetutorials.com/images/user-profile.png"
      );
    }

  } 
  

  echo "<script> updateConversations(); </script>";
} catch (Exeception $e) {
  echo $e;
}
?>