<?php



function createPost($post){

    $content = $post["text"];
    $title= $post["title"];
    $id = $post["id"];
    $time= $post["time"];
    $date= $post["date"];
    $user = $post["users"];
    $votes = $post["votes"];
 
    // WILL CREATE THE HTML ANSWER ELEMENT


    echo  
            "<div class='col'>
                <div>
                    <h2><a href='Question.php?id=$id' class='text-body'>$title</a></h2>
                </div>
            </div> 

            <div class='form-inline'>
 
                <div class='col secondary-text' id='text'> $content </div>

                <div class='col-1 vote-box'>
                    <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(true,$id)' >🔺</button>
                    <div  class='count' id='count-$id'> $votes </div>
                    <button type='button' class='btn btn-default btn-lg btn-block responsive-width' onclick='vote(false,$id)'>🔻</button>
                </div>
            

                <div class='container'>

                    <div>
                        <p class='text-muted'> Posted on  
                            <span class='text-secondary '> $date</span>
                            at  <span class='text-secondary'> $time</span>
                        </p>
                    </div>
                </div>
        
            </div>";
}


?>
