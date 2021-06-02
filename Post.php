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
    <link rel="stylesheet" type="text/css" href="vendor/jQuery-Tags-Input/dist/jquery.tagsinput.min.css" />
    <script type="text/javascript" src="vendor/jQuery-Tags-Input/dist/jquery.tagsinput.min.js"></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />

<!-- /tags -->
</head>

<body>
<?php 
    include 'navbar2.php';
    if (!isset($_SESSION["user_id"])) {
        session_destroy();
        header("Location: /HBz/Login.php",TRUE,302);
        die();
    }
?>
    <script>changeActiveLink("forum-link");</script> 

    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="inner-wrapper">

                <!-- Inner main -->
                <div class ="container">
                    <form method='POST' action="php/forum_php/insertPost.php">
                        <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item">
                                        <div class="media-body">

                                            <div class="row">
                                                <h1 class="h2 mb-4">Ask the forum</h1>
                                                <div>
                                                    
                                                    <input name="title" class="container-fluid" type="text"
                                                        placeholder="Title" aria-label="Title" required/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="container-fluid">
                                                <label for="editor">Your question</label>
                                                    <textarea name="text" id="editor"></textarea>
                                                </div>
                                                <br>
                                                <div class="container-fluid">
                                                    <label for="tags">Tags</label>
                                                    <input name="tags" id="tags"/>
                                                </div>
                                            </div>
                                           <br>
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



<script src="js/forum_js/question.js"> </script>
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


?>