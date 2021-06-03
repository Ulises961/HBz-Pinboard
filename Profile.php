<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hedgehog Pinboard</title>

  <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="css/home_main.css" rel="stylesheet">
  <link href="css/profile.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</head>

<body>

  <?php include "navbar2.php"; 
  if (!isset($_SESSION["user_id"])) {
    // session_destroy();
    // header("Location: /HBz/Login.php",TRUE,302);
    // die();
}
?>
  <script>changeActiveLink("profile-link");</script>
  
  <?php
    $_SESSION["user_id"] = 1; //This line is just for test purposes, it must be removed in the final version
    $user = $_SESSION["user_id"];
     
    if(isset($_REQUEST["user"]) && $_REQUEST["user"] != $_SESSION["user_id"])
      $user = $_REQUEST["user"];

    include "php/profile_php/getUserInfo.php"; 
  ?>

    <div class="container">
      <div class="main-body">
      
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                      <div class="mt-3">
                        <!-- FULL NAME -->
                        <h4>
                          <?php echo $user["name"]." ".$user["surname"]; ?>
                        </h4>

                        <!-- STUDENT OF / PROFESSOR OF -->
                        <p class="text-secondary mb-1">
                          <!-- THIS IS COMMENTED SINCE THE COMPLETE DATABASE IS NOT IN USE -->
                          <?php //echo $user["job"]; ?>
                        </p>

                        <!-- THIS WILL ENSURE THAT WE CANNOT CHAT WITH OURSELVES BUT ONLY WITH OTHER USERS -->
                        <?php
                          if(isset($_REQUEST["user"]) && $_REQUEST["user"] != $_SESSION["user_id"]){
                            $privateConversationParameters = "startConversationWithUser=" . $_REQUEST["user"]
                                                            ."&otherUserName=" . $user["name"];

                            echo "<a href='chat.php?$privateConversationParameters'>".
                                    "<button class='btn btn-outline-primary'> Message </button>".
                                  "</a>";
                          }
                        ?>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $user["name"]." ".$user["surname"]; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $user["mail"]; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $user["number"]; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- QUESTIONS ASKED -->
                <div class="card mb-3 ">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <i class="material-icons text-info mr-2">Questions asked</i>
                      </div>
                      <div class="col-sm-9 text-secondary questionsAskedCard">
                        <ul>
                          <?php include "php/profile_php/loadQuestionsAsked.php"; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ANSWERS GIVEN -->
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <i class="material-icons text-info mr-2">Answers given</i>
                      </div>
                      <div class="col-sm-9 text-secondary givenAnswersCard">
                        <ul>
                          <?php include "php/profile_php/loadAnswersGiven.php"; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
      </div>


  <!-- Footer -->
  <div class=footer>
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
      </div>
      <!-- /.container -->
    </footer>
  </div>
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
