<?php
function createQuestion($question){
    // WILL CREATE THE HTML QUESTION ELEMENT

$content = $question["text"];
$title= $question["title"];
$id = $question["id"];

echo "   <div class='card mb-2'>";
echo "      <div class='card-body p-2 p-sm-3'>";
echo "         <div class='media forum-item'>";
echo "          <a href='#' data-toggle='collapse' data-target='.forum-content'><img";
echo "             src='https://bootdey.com/img/Content/avatar/avatar2.png'";
echo "             class='mr-3 rounded-circle' width='50' alt='User' />
                </a>";
echo "           <div class='media-body'>";
echo "              <h6><a href='Question.php?id=$id' data-toggle='collapse' data-target='.forum-content'";
echo "                       class='text-body'>$title</a>
                    </h6>";
echo "              <p class='text-secondary'> $content</p>";
echo "              <p class='text-muted'><a href='javascript:void(0)'>jlrdw</a> replied 
                        <span class='text-secondary font-weight-bold'>3 hours ago</span>
                    </p>";
echo "           </div>";
echo "         </div>";
echo "      </div>";
echo "   </div>";


}
?>