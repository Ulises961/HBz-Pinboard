<?php


    include "forum_credentials.php";
    include "components/question.php";
    
    
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
    $questions= $query ->fetchAll(PDO::FETCH_ASSOC);
    

    
    $j = $index * 5 - 5; // starts from the first element of that page

    $i = $j + 5; // up to 5 questions per page
    $total_questions = count($questions);
    $total_pages = ceil($total_questions/5);
    while($j < $i && $j < $total_questions) {

        if( $question = $questions[$j])
        $question["text"]="";

        $class = ["class" => ""];
        $question = array_merge($question,$class);
       
        createQuestion($question);
        $j++;
    }

    include "components/paginator.php";
       

?>