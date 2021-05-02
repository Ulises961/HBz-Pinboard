<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!-- Custom styles for this template -->
    <link href="css/home_main.css" rel="stylesheet">
    <link href="forum.css" rel="stylesheet">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!-- tags -->
    <link rel="stylesheet" type="text/css" href="js/question_js/jQuery-Tags-Input/src/jquery.tagsinput.css" />
    <script type="text/javascript" src="js/question_js/jQuery-Tags-Input/dist/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="js/question_js/jQuery-Tags-Input/src/jquery.tagsinput.js"></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />

<!-- /tags -->
</head>

<body>
    <?php include 'navbar.php'?>
    <script>changeActiveLink("forum-link");</script> 
 

    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="inner-wrapper">

                <!-- Inner main -->
                <div class="jumbotron">
                    <form method='GET'>
                        <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item">
                                        <div class="media-body">

                                            <div class="row">
                                                <h2 class="h2 mb-4">Ask the forum</h2>
                                                <div>
                                                    <input name="title" class="container-fluid" type="text"
                                                        placeholder="Title" required/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <textarea name="text" id="editor"></textarea>
                                                </div>
                                                <div class="container-fluid">
                                                    <input name="tags" id="tags" placeholder="Add Tag"/>
                                                </div>
                                            </div>
                                           
                                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <!-- /Inner main -->
            </div>

        </div>
    </div>



<script src="js/question_js/question.js"> </script>

<script>   
    $('#tags').tagsInput({width:'inherit', height:'inherit'});
</script>

    <!-- Text Editor Template -->
    <script src="https://cdn.tiny.cloud/1/6qotqw98ccr1b86gtt4n68fo95mv1vbgdr3ov36z6cm83qxu/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
        selector: 'textarea#editor',
        plugins: [
        'advlist autolink link lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
        'table emoticons template paste'
        ],
        toolbar: 'styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link | print preview media fullpage | ' +
            'forecolor backcolor emoticons',
        
        menubar: 'file edit view insert format tools table',
            
            mobile: {
                menubar: true
            },

        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }   
    });
    </script>


</body>

</html>

<?php

include 'footer.php';
include 'php/forum_php/selectTags.php';
if (isset($_REQUEST['submit'])) {

    try {

        $host = "localhost";
        $dbname = "forum";
        $user = "postgres";
        $port = "5432";
        $password = "postgres";

        $conn_string = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$password";

        $user  = 1;
        $date  = date("d/m/y");
        $time  = date("H:i:s");
        $title = $_REQUEST["title"];
        $text  = $_REQUEST["text"];
        if ($text === "" || $text === "<p><br></p>" || $text === "<p><br data-mce-bogus='1'></p>")
            throw new Exception("No question provided");
       
        $dbh = new PDO($conn_string);

        $insert_into = "INSERT INTO Post(id, users, date, time, title, text, votes) ";
        $values = "VALUES(default, :user, :date, :time, :title, :text, 0)";
        $sql = $insert_into . $values;

        $insert = $dbh->prepare($sql);

        $insert->bindParam(":user", $user, PDO::PARAM_INT);
        $insert->bindParam(":date", $date, PDO::PARAM_STR);
        $insert->bindParam(":time", $time, PDO::PARAM_STR);
        $insert->bindParam(":title", $title, PDO::PARAM_STR);
        $insert->bindParam(":text", $text, PDO::PARAM_STR);
        $insert->execute();
        $id = $dbh->lastInsertId();

        $sql = "INSERT INTO Question(id) VALUES(:post)";

        $insert = $dbh->prepare($sql);
        $insert->bindParam(":post", $id, PDO::PARAM_INT);
        $insert->execute();

        if($_REQUEST["tags"] !== "")
         {      
             $tagId;
             $inputString = $_REQUEST['tags'];
             $lines = explode(",",$inputString);
       
            foreach($lines as $tag){
            
            try{
               
                $tag = strtolower($tag);

                $tagId = findTagId($tag);
             
                if( $tagId < 0){

                    $intoTags= "INSERT INTO Tag(id,name) VALUES(default, :tag)";
                    $insert = $dbh->prepare($intoTags);
                    $insert->bindParam(":tag", $tag, PDO::PARAM_INT);
                    $insert->execute();
                    $tagId = $dbh->lastInsertId();

                }

                $intoHasTags = "INSERT INTO HasTag (tag,post) VALUES(:tag, :post)";
                $insert = $dbh->prepare($intoHasTags);
                $insert->bindParam(":tag", $tagId, PDO::PARAM_INT);
                $insert->bindParam(":post", $id, PDO::PARAM_INT);
                $insert->execute();
                
            
            }
            catch(Exception $e){
                echo "<script>alert('Error: Failed to insert tag');</script>";
                throw new Exception("Failed to insert tag");
            }
           
         }
        }
        // THE FOLLOWING PHP CODE IS TO BE USED ONLY WHEN TESTING

        // $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";

        // $query = $dbh->prepare($sql);
        // $query->execute();

        // while ($question = $query->fetch())
        //     echo implode($question);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo "<script>alert('Error: $error');</script>";
       
    }

}


?>