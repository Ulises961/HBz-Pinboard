<?php

if(isset($_REQUEST["tags"])){
    $tags = $_REQUEST["tags"];
    $tags = json_decode($tags,true);
}
echo  " <div class='row'>";
                foreach($tags as $tag){

                    $tagName = $tag['name'];
                    $tagId= $tag['tag'];
                    echo 
                            "<div class='cols tag'>".
                               "<a href='forum.php?tag=$tagId'><span class='text-secondary font-weight-bold'># $tagName</span></a>".
                            "</div>";          
                }
                echo  "</div>";

?>