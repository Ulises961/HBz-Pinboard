<?php

include __DIR__."/../loadTags.php";

function createAnswer($answer){
  
    createPost($answer,false);

}


function createPost($post, $isPost){

    $content = $post["text"];
    $title= $post["title"];
    $id = $post["id"];
    $time= $post["time"];
    $date= $post["date"];
    $user = $post["users"];
    $votes = $post["votes"];

$tags = findAllTags($post["id"]);


$titleFormat = "<div class='col'>".
                    "<div>".
                        "<h2><a href='Question.php?id=$id' class='text-body'>$title</a></h2>".
                    "</div>".
                "</div>";  

$postInfo= "<div>
                <p class='text-muted'> Posted on  
                    <span class='text-secondary '> $date</span>
                    at  <span class='text-secondary'> $time</span>
                </p>
            </div>";


    // WILL CREATE THE HTML ANSWER ELEMENT
    if( $isPost){
        $class = "";
        $break="";
    }else{
        $class = "answer";
        $titleFormat="";
        $postInfo="";
        $break=  "<hr>";
       
    }
    echo $titleFormat;
 
    echo "<div>";
    echo "<div class='$class form-inline '>";
 

    echo "   <div class='col secondary-text' id='text'> $content </div>";


    echo    "<div class='col-1 vote-box'>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,$id)' >🔺</button>";
    echo        "<div  class='count' id='count-$id'> $votes </div>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,$id)'>🔻</button>";
    echo    "</div>";
    echo    "</div>";

    
    if(count($tags) > 0){
        echo "<div class='container'>";
            include "tag.php";
        echo "</div>";

    }

    echo    "<div class='container'>"; 
    echo $postInfo;
    echo    "</div>";
  
    echo    "</div>";
    echo $break;
}



?>
