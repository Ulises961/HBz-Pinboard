<?php
include "chat_credentials.php";
include "components/conversation.php";

// right now we are onlu testing and there is no session vairable set
// $user = $_SESSION["user"]; 
$user = 1; 

try {
  $isConversationPriavte = false;
  $dbh = new PDO($conn_string);
  
  $getGroupConversation = "SELECT id, name, last_change, last_message ".
                          "FROM conversation , partecipatesinconversation ".
                          "WHERE id = conversation AND users = :user";

  $query= $dbh -> prepare($getGroupConversation);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0) 
    while($conversation = $query->fetch())
      createConversationElement($conversation, $isConversationPriavte);

  $isConversationPriavte = true;
  $getPrivateConversations = "SELECT id, name, last_change, last_message ".
                             "FROM PrivateConversation ".
                             "WHERE user_a = :user OR user_b = :user";


  $query= $dbh -> prepare($getPrivateConversations);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0) 
    while($conversation = $query->fetch())
      createConversationElement($conversation, $isConversationPriavte);  

  echo "<script> updateConversations(); </script>";
} catch (Exception $e) {
  echo $e;
}
?>