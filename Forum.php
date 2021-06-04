<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="css/home_main.css" rel="stylesheet">
    <link href="css/forum.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include "navbar2.php"; 
    
    if (isset($_SESSION['message'])){
        // echo "<script>alert('".$_SESSION['message']."')</script>";
        // unset($_SESSION['message']);
    }

    if (!isset($_SESSION["user_id"])) {
      
        // destroy the session
        // session_destroy(); 
      
        // header("Location: /HBz/Login.php",TRUE,302);
        // die();
    }
    
?>
    <script>changeActiveLink("forum-link");</script>
 

    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="container">
                <h1>HBz Forum</h1>
              
              
                <!-- Inner main -->
                <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                    <!-- Inner main header -->
                        <div class="inner-main-header">

                            <div class="col-sm-2">
                                <button class="btn btn-primary has-icon btn-block" type="button" onclick="location = 'Post.php'"> 
                                    New Question
                                </button>
                            </div>

                            <div class="col-sm-6 sort-flex">
                                <span class="input-icon input-icon-sm ml-auto w-auto">
                                    <input type="text"
                                        class="form-control form-control-sm bg-gray-200 border-gray-200 shadow-none mb-4 mt-4"
                                        placeholder="Search forum" onchange="searchForum(this)" aria-label="Search Forum" />
                                </span>
                            </div>

                            <div class="col-sm-4 container" id="sortColumn">
                          
                                <select class="custom-select custom-select-sm mr-1" name="filters" id="selectSort"  aria-label="Sort by">
                                    <option selected="">Sort by</option>
                                    <option value="latest">Latest</option>
                                    <option value="popular">Popular</option>
                                </select>
                                <button class="btn btn-secondary" onclick="sortForum()">Sort</button>
                            </div>        
                        </div>
                    <!-- /Inner main header -->
                </div>
               

                <!-- Inner main body -->

                    <!-- Forum List -->
                    <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                        <div id="questions" onready="location = 'Forum.php?page=1'">
                            <?php include "php/forum_php/loadQuestions.php";?>
                        </div>
                    </div>
                    <!-- /Forum List -->

                <!-- /Inner main body -->
                </div>
                <!-- /Inner main -->
            </div>

          
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>


    <script src="js/forum_js/question.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>

</html>