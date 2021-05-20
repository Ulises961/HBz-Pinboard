<?php

    include "forum_credentials.php";
    session_start();

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
        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id WHERE p.title LIKE '%$cleanWords[0]%' ";
        $i = 1;
        while($i < $searchWordsLength){
            $sql .= "or p.title LIKE '%$cleanWords[$i]%'";
       
            $i++;
        }
    }

    $query = $dbh-> prepare($sql);
  
    $query -> execute();

    $results= $query ->fetchAll(PDO::FETCH_ASSOC);



    $_SESSION["questions"] = serialize($results);
   
   include "indexer.php";  // PLACES THE QUESTIONS IN SET OF 5 PER VIEW


?>