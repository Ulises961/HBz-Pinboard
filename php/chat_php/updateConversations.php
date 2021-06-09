<?php
include "../credentials.php";

// right now we are onlu testing and there is no session vairable set
$user = $_SESSION["user_id"]; 

try {
  $dbh = new PDO($conn_string);

  $getGroupConversation = "SELECT id, name, last_change, last_message ".
                          "FROM conversation , partecipatesinconversation ".
                          "WHERE id = conversation AND users = :user";


  $query= $dbh -> prepare($getGroupConversation);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  $conversations = array();
  

  if($query->rowCount() > 0)
    while($row = $query->fetch())
      array_push($conversations, json_encode($row));
 
  $getPrivateConversations = "SELECT id, name, last_change, last_message ".
                             "FROM PrivateConversation ".
                             "WHERE user_a = :user OR user_b = :user";

  $query= $dbh -> prepare($getGroupConversation);
  $query-> bindParam(':user', $user, PDO::PARAM_INT);
  $query-> execute();

  if($query->rowCount() > 0)
    while($row = $query->fetch())
      array_push($conversations, json_encode($row));
      

  if(!empty($conversations))
    echo json_encode($conversations);

} catch (Exception $e) {
  echo $e;
}
?>