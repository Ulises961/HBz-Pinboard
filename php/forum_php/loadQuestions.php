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
        
        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id ".$orderby;
        $query = $dbh-> prepare($sql);

    }else{ 

        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id JOIN HasTag h ON p.id=h.post WHERE h.tag=:tag ".$orderby;
        $query = $dbh-> prepare($sql);
        $query -> bindParam(":tag", $tag,PDO::PARAM_INT); 
    }

    $query -> execute();
    $results= $query ->fetchAll(PDO::FETCH_ASSOC);
    

    $_SESSION["questions"] = serialize($results);
   
    include "indexer.php";
       

?>