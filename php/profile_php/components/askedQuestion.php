<?php

function createAskedQuestion($askedQuestion){
    $questionId = $askedQuestion["id"];
    $questionTitle = $askedQuestion["title"];

    echo "<li>";
    echo    "<a href='Question.php?id=$questionId'>$questionTitle</a>";
    echo "</li>";
}

?>