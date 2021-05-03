<?php


    include "forum_credentials.php";
    include "components/question.php";

    $dbh = new PDO($conn_string);
    $query;
    $tag="";
    $orderby="";
    if(isset($_REQUEST["tag"]))
        $tag = $_REQUEST["tag"];
    if(isset($_REQUEST["orderby"])){
        $parameter= $_REQUEST["orderby"];
        
        switch ($parameter){
            case "latest": $orderby = "ORDER BY (date,time) DESC;";
                break;
            case "popular": $orderby = "ORDER BY (votes) DESC;";
                break;
            
            }     
    }
      
    if($tag !== ""){    
        
        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id JOIN HasTag h ON p.id=h.post WHERE h.tag=:tag ".$orderby;
        $query = $dbh-> prepare($sql);
        $query -> bindParam(":tag", $tag,PDO::PARAM_INT); 
    }else{ 
        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id ".$orderby;
        $query = $dbh-> prepare($sql);
    
    }
   
    $query-> execute();

    while ($question = $query->fetch()){
   
        createQuestion($question);
    }


?>