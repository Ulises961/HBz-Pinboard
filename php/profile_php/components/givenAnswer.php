<?php

function createGivenAnswer($givenAnswer){
    $questionId = $givenAnswer["questionId"];
    $question = $givenAnswer["title"];

    echo "<a href='Question.php?id=$questionId'>$question</a>";
}

?>