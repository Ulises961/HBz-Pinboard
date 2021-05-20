<?php 

include "components/question.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$questions = unserialize($_SESSION["questions"]);

$index = 1;

if(isset($_REQUEST["page"]))
    $index = $_REQUEST["page"];

$j = $index * 5 - 5; // starts from the first element of that page

$i = $j + 5; // up to 5 questions per page
$total_questions = count($questions);
$total_pages = ceil($total_questions/5);
while($j < $i && $j < $total_questions) {

    if( $question = $questions[$j])
    $question["text"]="";

    $class = ["class" => ""];
    $question = array_merge($question,$class);
   
    createQuestion($question);
    $j++;
}

include "components/paginator.php";

?>