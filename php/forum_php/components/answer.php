<?php
function createAnswer($answer){
    
    include ("php/forum_php/loadVotes.php");

    // WILL CREATE THE HTML ANSWER ELEMENT
 
    echo "<div class='answer form-inline'>";

    echo    "<div class='col question-content' id='text'>".$answer['text']."</div>";

    echo    "<div class='col-1 vote-box'>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,". $answer['id'].")' >🔺</button>";
    echo        "<div  class='count' id='count-".$answer['id']."'>".$result['total']."</div>";
    echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,".$answer["id"].")'>🔻</button>";
    echo    "</div>";

    
    echo "</div>";
    
    echo "<hr>";
}
?>
