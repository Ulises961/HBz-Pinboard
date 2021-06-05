<?php

include_once __DIR__."/post.php";


function createAnswer($answer){
  
    $answer["title"]="";
    $id = $answer["id"];
    
    echo " <!-- Answer -->  \n
    <div class ='answer'>
        <div class='row'>";
    createPostHeader($answer);
    createPostBody($answer,true);

        echo "</div>";

    echo    
        "<div id='comments-$id'>";
            include_once __DIR__."/../loadComments.php";
    echo    
        " </div>
        <div class='insert-comment'>
           
                <input class='' type='text' id='insertComment-$id' placeholder='Insert Comment' aria-label='Insert comment'>
        
                <button class='btn btn-primary' onclick='insertComment($id)'> Post </button>
        </div>";
  
        echo "</div>
    <!-- / Answer -->  ";

}



?>