<?php

function createGivenAnswer($givenAnswer){
    $questionId = $givenAnswer["question_id"];
    $question = $givenAnswer["title"];

    echo "<li>";
    echo    "<a href='Question.php?id=$questionId' style='color: black'>$question</a>";
    echo "</li>";
}

?>