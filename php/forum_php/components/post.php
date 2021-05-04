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
$thereAreTags= count($tags) > 0;

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
 
    echo "<div>
            <div class='$class form-inline '>
 

                <div class='col secondary-text' id='text'> $content </div>


                <div class='col-1 vote-box'>
                    <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,$id)' >🔺</button>
                    <div  class='count' id='count-$id'> $votes </div>
                    <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,$id)'>🔻</button>
                </div>
            </div>";


   if($thereAreTags) {
    echo "<div class='container'>";
        include "tag.php";
    echo "</div>";
    }

    echo    "<div class='container'>
                $postInfo
            </div>
          
            <div id='comments-$id'>";
    
                include __DIR__."/../loadComments.php";
           
    echo    " </div>
            <div class='row' >
                <div class='col-9'>
                    <input class='' type='text' id='insertComment-$id' placeholder='Insert Comment'>
                </div>
                <div class='col'>
                    <button class='btn btn-primary btn-lg' onclick='insertComment($id)'> Post </button>
                </div>
            </div>
        </div>
    
     $break";
}


?>
