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

include 'navbar.php'; 
include "php/forum_php/components/post.php";
$id = $_GET["id"];

?>
    <script>changeActiveLink("forum-link");</script>
    
    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="inner-wrapper">
             
                <!-- Inner main -->
                <div class="container">
                    <div class ="card">

                <?php include "php/forum_php/loadSelectedQuestion.php"  ?>
                    <!-- <div class="col">
                                <div>
                                    <h2 id ="title">Hello World
                                </div>
                            </div>  
                        <div class="form-inline">                        

                             -->
                            <!-- Question  -->
                            <!-- <div class="col question-content" id="text">This is some text</div> -->
                            <!-- /Question -->

                            <!-- <div class="col-1 vote-box">
                                    <button type="button" class="btn btn-default btn-lg btn-block responsive-width" onclick="vote(true, <?php echo $id?>)" >🔺</button>
                                    <div class ="count" id="count-<?php echo $id?>"></div>
                                    <button type="button" class="btn btn-default btn-lg btn-block responsive-width" onclick="vote(false, <?php echo $id?>)">🔻</button>    
                            </div>
                        </div>
                        -->
                        <!-- Answers -->
                            <div id="answer"><?php include "php/forum_php/loadAnswers.php" ?></div>
                        <!-- /Answers -->
            

                        <form target="_blank" id="form"> 
                            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                            <div id="answer"></div>
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div>
                                                <div>
                                                 
                                                    <div class="row">
                                                        <h3 class="h3 pt-4">Your Idea</h3>
                                                        <label>Describe the issue in detail</label>
                                                        <div class="container-fluid">
                                                            <textarea name="text" id="editor"></textarea>
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
                
                </div>    <!-- /Inner main -->
            </div>

        </div>
    </div>



</body>

</html>


<script src="js/question_js/question.js"></script>

<script>document.addEventListener("load",getQuestion(<?php echo "$id"?>)); </script>
<script>document.getElementById("form").addEventListener("click", function(event) {
         insertAnswer(<?php echo $id?> ,1);
         event.preventDefault();
}, false);</script>
<!-- Text Editor Template -->
<script src="https://cdn.tiny.cloud/1/6qotqw98ccr1b86gtt4n68fo95mv1vbgdr3ov36z6cm83qxu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- <script>
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
            content_css: 'css/content.css',
            mobile: {
                menubar: true
            }
        
    });
</script> -->

