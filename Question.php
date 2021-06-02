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
  

</head>

<body>

<?php

  
include 'navbar2.php'; 
    if (!isset($_SESSION["user_id"])) {
    session_destroy();
    header("Location: /HBz/Login.php",TRUE,302);
    die();
}
include "php/forum_php/components/post.php";
$id = $_GET["id"];

?>
    <script>changeActiveLink("forum-link");</script>
    
    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="container">
             
                <!-- Inner main -->
               
                    <div class ="card mb-2">

                        <?php include "php/forum_php/loadSelectedQuestion.php"?>
               
                    
                        <!-- Answers -->
                            <div id="answer"><?php include "php/forum_php/loadAnswers.php" ?></div>
                        <!-- /Answers -->
            

                        <form id="form"> 
                            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                                <div id="answer"></div>
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div>
                                                <div class="row">
                                                   <label for="editor"> <h2 class="h3 pt-4">Your Idea</h3></label>
                                                        
                                                    <div class="container-fluid">
                                                        <textarea name="text" id="editor"></textarea> 
                                                    </div>
                                                    <button name="submit" id="submit"  class="btn btn-primary">Submit</button>
                                                </div>           
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div> <!-- /Inner main -->
                
                   
            </div>

        </div>
    </div>



</body>

</html>


<script src="js/forum_js/question.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
    document.getElementById("form").addEventListener("submit", function(event) {
   try{
    
        console.log(event.srcElement[0].value);
        if (event.srcElement[0].value === "" || event.srcElement[0].value ==='<p><br data-mce-bogus="1"></p>' || event.srcElement[0].value ==="<p><br></p>"){
            console.log(event.srcElement[0].value);
         throw( "Empty Answer");
        }
        else{
            insertAnswer(<?php echo $id?> ,1);  
            event.preventDefault(); 
        }
    } catch(e){
        alert("Error: "+ e);
    }


}, true);</script>

<!-- Text Editor Template -->
<script src="https://cdn.tiny.cloud/1/6qotqw98ccr1b86gtt4n68fo95mv1vbgdr3ov36z6cm83qxu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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

