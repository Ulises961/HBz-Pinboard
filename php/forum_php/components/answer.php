<?php

include_once __DIR__."/post.php";


function createAnswer($answer){
    $class = ["class" => "answer"];
    $answer["title"]="";
    $answer = array_merge($answer,$class);
    $id = $answer["id"];
echo " <!-- Answer -->  ";
    createPost($answer);



    echo    
        "<div id='comments-$id'>";
            include_once __DIR__."/../loadComments.php";
    echo    
        " </div>
        <div class='row' >
            <div class='col-9'>
                <input class='' type='text' id='insertComment-$id' placeholder='Insert Comment'>
            </div>
            <div class='col'>
                <button class='btn btn-primary btn-lg' onclick='insertComment($id)'> Post </button>
            </div>
        </div>
    <hr>

    <!-- / Answer -->  ";

}



?>