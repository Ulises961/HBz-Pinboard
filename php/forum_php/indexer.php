<?php 

include "components/question.php";

if (session_status() == PHP_SESSION_NONE) {

    session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true]);

}
$questions = unserialize($_SESSION["questions"]);

$total_questions = count($questions);
$total_pages = ceil($total_questions/5);


$index = 1;


$currentSet = $_SESSION["current_set"];
$start_of_set = $currentSet-9;

if(isset($_REQUEST["page"])){
    $index = $_REQUEST["page"];

    if($index < $start_of_set)
        $currentSet -=10;
    if($index > $currentSet)
        $currentSet += 10;
}
   
elseif(isset($_REQUEST["next_set"])){
    if($_REQUEST["next_set"] === "prev"){
        $currentSet = $currentSet - 10;
        $index = $currentSet -9;
    }else{
        
        $currentSet = $currentSet + 10;
        $index = $currentSet -9;
    }
    

}
$start_of_set = $currentSet-9;
$_SESSION["current_set"] = $currentSet;

$j = $index * 5 - 5; // starts from the first element of that page

$i = $j + 5; // up to 5 questions per page

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