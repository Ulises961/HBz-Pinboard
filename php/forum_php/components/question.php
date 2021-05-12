<?php

include_once __DIR__."/../loadTags.php";
include_once "post.php";

// WILL CREATE THE HTML QUESTION ELEMENT
function createForumQuestion($question){

    $tags = findAllTags($question["id"]);
    $thereAreTags= count($tags) > 0;
 
    echo 
    "<!-- Question -->".

        "<div class='card mb-2'>
            <div class='card-body p-2 p-sm-3'>
                <div class='media forum-item'>
                    <a href=''><img src='' class='mr-3 rounded-circle' width='70' alt='User'></a>
                        <div class='media-body'>";

                            createPost($question);
                        
                            if($thereAreTags){
                               
                                includeTags($tags);
                            }
                               
    echo "
                        </div>
                </div>
            </div>     
        </div>
    <!--/ Question -->";

}

function createQuestionToBeAnswered($question){
  
    $tags = findAllTags($question["id"]);
    $thereAreTags= count($tags) > 0;
    $id = $question["id"];
  echo  " <!-- Question -->";

    createPost($question);
  
    if($thereAreTags) {
     
        includeTags($tags);

    }
       
        
    echo    
            "<div id='comments-$id'>";
                include_once __DIR__."/../loadComments.php";
    echo    
            "</div>
            <div class='row' >
                <div class='col-9'>
                    <input class='' type='text' id='insertComment-$id' placeholder='Insert Comment'>
                </div>
                <div class='col'>
                    <button class='btn btn-primary btn-lg' onclick='insertComment($id)'> Post </button>
                </div>
            
            
            </div>
        <!-- / Question -->";

}


function includeTags($tags){

    echo "<div class='container'>";
            include "tag.php";
    echo "</div>";
  }
  
?>