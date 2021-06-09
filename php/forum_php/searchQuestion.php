<?php

    include "../credentials.php";

    
    $dbh = new PDO($conn_string);
    $query;
    $cleanWords= array();

    if(isset($_REQUEST["question"]))
        $searchWords= explode(" ",$_REQUEST["question"]);
        $searchWordsLength = count($searchWords);
        
        foreach($searchWords as $searchWord){
            $searchWord = filter_var($searchWord,FILTER_SANITIZE_STRING);
            $cleanWords= array_merge($cleanWords,[$searchWord]);}
    if( $searchWordsLength > 0){

        $select = "SELECT p.id AS id, p.date AS date, p.time AS time, p.title AS title, u.name AS name,  p.votes AS votes , p.text AS text , u.picture AS picture, u.id AS userid";
        $from = " FROM Post p JOIN Question q ON p.id = q.id JOIN Users u ON p.users = u.id";
        $where = " WHERE p.title LIKE '%$cleanWords[0]%' ";
        
        $i = 1;
        while($i < $searchWordsLength){
            $where .= "or p.title LIKE '%$cleanWords[$i]%'";
       
            $i++;
        }
    }

    $sql = $select.$from.$where;

    $query = $dbh-> prepare($sql);
  
    $query -> execute();

    $results= $query ->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["current_set"]= 10;

    $_SESSION["questions"] = serialize($results);
   
   include "indexer.php";  // PLACES THE QUESTIONS IN SET OF 5 PER VIEW


?>