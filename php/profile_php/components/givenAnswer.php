<?php

function createGivenAnswer($givenAnswer){
    $questionId = $givenAnswer["question_id"];
    $question = $givenAnswer["title"];

    echo "<li>";
    echo    "<a href='Question.php?id=$questionId'>$question</a>";
    echo "</li>";
}

?>