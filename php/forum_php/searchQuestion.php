<?php

    include "forum_credentials.php";
    include "components/question.php";

    $dbh = new PDO($conn_string);
    $query;
    
    if(isset($_REQUEST["question"]))
        $searchWords= explode(" ",$_REQUEST["question"]);
        $searchWordsLength = count($searchWords);
  
    
    if( $searchWordsLength > 0){
        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id WHERE p.title LIKE '%$searchWords[0]%' ";
        $i = 1;
        while($i < $searchWordsLength){
            $sql .= "or p.title LIKE '%$searchWords[$i]%'";
       
            $i++;
        }
    }

    $query = $dbh-> prepare($sql);
  
    $query -> execute();
  
    
    while ($question = $query->fetch()){
        
       
        
        $class = ["class" => ""];
        $question = array_merge($question,$class);
        
        createForumQuestion($question);
    }



?>