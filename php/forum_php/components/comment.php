<?php

function createComment($comment){
    // WILL CREATE THE HTML COMMENT ELEMENT
$content = $comment["text"];
$date = $comment["date"];

  echo              "<div class='container'>
                        <p class='secondary-text'>$content</p>
                        <div class='row'>".
                          //   <div class ='col'><p> Author: John Wayne</p></div>
                            "<div class ='col'><p> Date: $date</p></div>
                        </div>
                    </div>";

}
?>