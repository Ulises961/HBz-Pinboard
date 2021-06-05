<?php

include_once __DIR__."/../loadTags.php";
include_once __DIR__."/post.php";

// WILL CREATE THE HTML QUESTION ELEMENT
function createQuestion($question){

    $tags = findAllTags($question["id"]);
    
    echo 
    "<!-- Question -->".

        "<div class='card mb-2'>
            <div class='card-body p-2 p-sm-3'>
                <div class='media forum-item'>
                    
                    <div class='row'>";
                        createPostHeader($question);     
                        createPostBody($question,false);
                        includeTags($tags);        
    echo "
                    </div>
                </div>
            </div>     
        </div>
    <!--/ Question -->";

}


?>