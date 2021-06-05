<?php


    include "forum_credentials.php";


    
    $dbh = new PDO($conn_string);
    $query;
    $tag="";
    $index = 1;

    $orderby="";
    if(isset($_REQUEST["tag"]))
        $tag = $_REQUEST["tag"];
    if(isset($_REQUEST["page"]))
        $index = $_REQUEST["page"];

      
    if(isset($_REQUEST["orderby"])){
        $parameter= $_REQUEST["orderby"];
    
    
    
    
        switch ($parameter){
            case "latest": $orderby = "ORDER BY (date,time) DESC;";
                break;
            case "popular": $orderby = "ORDER BY (votes) DESC;";
                break;
            
            }     
    }
      
    if($tag === ""){    
        
        $select = "SELECT p.id AS id, p.date AS date, p.time AS time, p.title AS title, u.name AS name,  p.votes AS votes, u.picture AS picture ";
        $from = " FROM Post p JOIN Question q ON p.id = q.id JOIN Users u on p.users = u.id ".$orderby;
        $sql =$select.$from;
        $query = $dbh-> prepare($sql);

    }else{ 

        $select = "SELECT p.id AS id, p.date AS date, p.time AS time, p.title AS title, u.name AS name,  p.votes AS votes, u.picture AS picture";
        $from = " FROM Post p JOIN Question q ON p.id = q.id JOIN HasTag h ON p.id=h.post JOIN Users u on p.users = u.id";
        $where = " WHERE h.tag=:tag ".$orderby;
        $sql =$select.$from.$where;
        $query = $dbh-> prepare($sql);
        $query -> bindParam(":tag", $tag,PDO::PARAM_INT); 
    }

    $query -> execute();
    $results= $query ->fetchAll(PDO::FETCH_ASSOC);
    
    $_SESSION["current_set"]= 10;

    $_SESSION["questions"] = serialize($results);
   
    include "indexer.php";
       

?>