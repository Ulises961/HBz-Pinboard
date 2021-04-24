<?php
function createPost($post){
    
    include ("php/forum_php/loadVotes.php");

    // WILL CREATE THE HTML ANSWER ELEMENT
 
    echo "<div class='".$post['class']." form-inline'>";

    echo    "<div class='col question-content' id='text'>".$post['text']."</div>";

    echo    "<div class='col-1 vote-box'>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,". $post['id'].")' >🔺</button>";
    echo        "<div  class='count' id='count-".$post['id']."'>".$result['total']."</div>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,".$post["id"].")'>🔻</button>";
    echo    "</div>";

    
    echo "</div>";
    
    echo "<hr>";
}
?>
