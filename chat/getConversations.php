<?php
    include "php/conversationElement.php";
    
    // The database credentials must be stored in another folder
    $host = "localhost";
    $dbname = "chat_test";
    $user = "postgres";
    $port = "5432";
    $password = "postgres";
    
    $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";

    // right now we are onlu testing and there is no session vairable set
    // $user = $_SESSION["user"]; 
    $user = 1; 

    try {
      $dbh = new PDO($conn_string);

      $select = "SELECT c.id, c.name ";
      $from = "FROM conversation c, partecipatesinconversation p ";
      $where = "WHERE c.id = p.conversation AND p.users = :user";

      $sql =  $select.$from.$where;

      $query= $dbh -> prepare($sql);
      $query-> bindParam(':user', $user, PDO::PARAM_INT);
      $query-> execute();

      if($query->rowCount() > 0) {

        while($row = $query->fetch()){
          createConversationElement(
            $row["id"],
            $row["name"],
            "02/04/2021",
            "Ex qui sit nostrud aliqua adipisicing consequat. Dolore commodo adipisicing esse esse et adipisicing velit minim labore veniam ex.",
            "https://ptetutorials.com/images/user-profile.png"
          );
        }

      } 

    } catch (Exeception $e) {
      echo $e;
    }
?>