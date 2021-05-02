<?php
function createQuestion($question, $tags){
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
echo "          <a href='Profile.php?user=$user'><img";
echo "             src='https://webservices.scientificnet.org/rest/uisdata/api/v1/people/3466/image'";
echo "             class='mr-3 rounded-circle' width='70' alt='User' />
                </a>";
echo "           <div class='media-body'>";
echo "              <h4>
                        <a href='Question.php?id=$id' class='text-body'>$title</a>
                    </h4>";

echo    "<div class='row'>";
            
echo "   <div class='col'> <p class='text-secondary'> $content</p> </div>";

                
echo    "<div class='col-1 vote-box'>";
echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,". $question['id'].")' >🔺</button>";
echo        "<div  class='count' id='count-".$question['id']."'>".$question['votes']."</div>";
echo        "<button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,".$question["id"].")'>🔻</button>";
echo    "</div>";

echo    "</div>";

echo "              <p class='text-muted'> Posted on  
                        <span class='text-secondary '> $date</span>
                        at  <span class='text-secondary'> $time</span>
                    </p>";
            if(count($tags) > 0){

                echo  " <div class='row'>";
                
                foreach($tags as $tag){
                    $tagName = $tag['name'];
                  
                    $tagId= $tag['id'];
                    echo 
                            "<div class='cols tag'>".
                               "<a href='forum.php?tag=$tagId'><span class='text-secondary font-weight-bold'># $tagName</span></a>".
                            "</div>";          
                }
                echo  "</div>";
            }
echo "           </div>";
echo "         </div>";
echo "      </div>";
echo "   </div>";


}
?>