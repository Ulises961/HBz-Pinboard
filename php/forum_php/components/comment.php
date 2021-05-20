<?php

function createComment($comment){
    // WILL CREATE THE HTML COMMENT ELEMENT
$content = $comment["text"];
$date = $comment["date"];

  echo        " <!-- Comment -->  ".  
                  "<div class='comment'>
                        <p >$content</p>
                        <div class='row'>".
                          //   <div class ='col'><p> Author: John Wayne</p></div>
                            "<div class ='col text-secondary'><p> Date: $date</p></div>
                        </div>
                    </div>
                <!-- / Comment -->  ";

}
?>