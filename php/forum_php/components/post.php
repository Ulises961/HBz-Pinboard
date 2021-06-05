<?php

function createPostHeader($post){

   
    $id = $post["id"];
    $votes = $post["votes"];
 
    // WILL CREATE THE HTML ANSWER ELEMENT


    echo  
            "
            <div class='col-1 vote-box'>
                <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,$id)' >🔺</button>
                <div  class='count' id='count-$id'> $votes </div>
                <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,$id)'>🔻</button>
            </div>";
}

function createPostBody($post,$isAnswer){

    $content = $post["text"];
    $time= $post["time"];
    $date= $post["date"]; 
    $id = $post["id"];
    $title = $post["title"];
    $user = $post["name"];
    $picture = $post["picture"];
    $userId = $post["userid"];

    $show="";
 $linkToQuestion = " <h1><a href='Question.php?id=$id' class='text-body'>$title</a></h1>";
    if($isAnswer){
        $linkToQuestion="";
     
    }
        
    echo"
            <div class='col'>
                
               $linkToQuestion
                
                <div class='primary-text' id='text'> $content </div>

            </div>
            <div>
                <p class='text-muted'> Posted on  
                    <span class='text-secondary '> $date </span>
                    at  <span class='text-secondary'> $time </span>
                    <span> by  $user <a href='Profile.php?user=$userId'><img src='$picture' class='mr-3 rounded-circle' width='70' alt='User'></a></span>
                </p>
                

            </div>";
     
}


?>
