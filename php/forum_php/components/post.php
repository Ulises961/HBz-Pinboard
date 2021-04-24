<?php


function createPost($post,$isAnswer){
    
  
include "php/forum_php/loadVotes.php";
  
    
$titleFormat = "<div class='col'>".
                    "<div>".
                        "<h2 id ='title'>".$post["title"].
                    "</div>".
                "</div>";   



    // WILL CREATE THE HTML ANSWER ELEMENT
    if( $isAnswer){
        $class = "answer";
        $titleFormat="";
    }else{
        $class = "";
    }
    echo $titleFormat;

    echo "<div class='". $class ." form-inline'>";


    echo    "<div class='col question-content' id='text'>".$post['text']."</div>";

    echo    "<div class='col-1 vote-box'>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,". $post['id'].")' >🔺</button>";
    echo        "<div  class='count' id='count-".$post['id']."'>".$result['total']."</div>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,".$post["id"].")'>🔻</button>";
    echo    "</div>";

    
    echo "</div>";
    
    echo "<hr>";
}

function createAnswer($answer){
  
    createPost($answer,true);

}



?>
