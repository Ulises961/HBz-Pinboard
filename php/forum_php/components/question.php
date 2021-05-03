<?php
include "post.php";
function createQuestion($question){
    // WILL CREATE THE HTML QUESTION ELEMENT

$content = $question["text"];
$title= $question["title"];
$id = $question["id"];
$time= $question["time"];
$date= $question["date"];
$user = $question["users"];


echo "   <div class='card mb-2'>";
echo "      <div class='card-body p-2 p-sm-3'>";
echo "         <div class='media forum-item'>";
echo "          <a href='https://webservices.scientificnet.org/rest/uisdata/api/v1/people/3466/image'><img";
echo "             src='https://webservices.scientificnet.org/rest/uisdata/api/v1/people/3466/image'";
echo "             class='mr-3 rounded-circle' width='70' alt='User' />
                </a>";
echo "           <div class='media-body'>";
   
    createPost($question,true);


echo "           </div>";
echo "         </div>";
echo "      </div>";
echo "   </div>";


}
?>