<?php

function createGivenAnswer($givenAnswer){
    $questionId = $givenAnswer["questionId"];
    $question = $givenAnswer["title"];

    echo "<li>";
    echo    "<a href='Question.php?id=$questionId'>$question</a>";
    echo "</li>";
}

?>