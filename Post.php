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


    <script src="https://cdn.tiny.cloud/1/6qotqw98ccr1b86gtt4n68fo95mv1vbgdr3ov36z6cm83qxu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Text Editor Template -->
    <script src="https://cdn.tiny.cloud/1/6qotqw98ccr1b86gtt4n68fo95mv1vbgdr3ov36z6cm83qxu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullpage | ' +
            'forecolor backcolor emoticons | help',
        
            menubar: 'file edit view insert format tools table help',
            content_css: 'css/content.css',
            mobile: {
                menubar: true
            }
           
        });
    </script>
       
</head>

<body>
    <!-- <?php //include 'navbar.php'; ?>
    <script>changeActiveLink("forum-link");</script> -->


    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="inner-wrapper">
             
                <!-- Inner main -->
                <div class="jumbotron">
                <form method='POST'> 
                    <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                            <div class="card mb-2">
                                <div class="card-body p-2 p-sm-3">
                                    <div class="media forum-item">
                                        <div class="media-body">

                                            <div class="row">
                                                <h2 class="h2 mb-4">Realtime Fetching Data</h2>
                                                <div>
                                                    <input name="title" class="container-fluid" type="text" placeholder="Title"/>
                                                </div>
                                            </div>
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
                <!-- /Inner main -->
            </div>

        </div>
    </div>

 
</body>

<?php include 'footer.php'; ?>           

<?php


if(isset($_POST['submit'])){ 

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
    try {
        $dbh = new PDO($conn_string);

        $insert_into = "INSERT INTO Post(id, users, date, time, title, text) ";
        $values = "VALUES(default, :user, :date, :time, :title, :text)";
        $sql = $insert_into.$values;

        $insert = $dbh-> prepare($sql);

        $insert-> bindParam(":user", $user, PDO::PARAM_INT);
        $insert-> bindParam(":date", $date, PDO::PARAM_STR);
        $insert-> bindParam(":time", $time, PDO::PARAM_STR);
        $insert-> bindParam(":title", $title, PDO::PARAM_STR);
        $insert-> bindParam(":text", $text, PDO::PARAM_STR);
        $insert-> execute();
        $id = $dbh-> lastInsertId();

        $sql = "INSERT INTO Question(id) VALUES(:post)";

        $insert = $dbh-> prepare($sql);
        $insert-> bindParam(":post", $id, PDO::PARAM_INT);
        $insert->execute();

        $sql = "SELECT * FROM Post p JOIN Question q ON p.id = q.id";

        $query = $dbh-> prepare($sql);
        $query-> execute();

        while ($question = $query->fetch())
            echo implode($question);

    } catch (Exception $e) {
        echo"error: $e";
    }
}
?>




</html>