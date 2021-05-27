<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hedgehog Pinboard</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="css/home_main.css" rel="stylesheet">
  <link href="forum.css" rel="stylesheet">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <script src="js/contact_js/contact_logic.js"></script>

</head>

    
<body>


    <!-- Navigation -->
    <?php include "navbar.php";
    // if (!isset($_SESSION["user_id"])) {
    //     session_destroy();
    //     header("Location: /HBz/Login.php",TRUE,302);
    //     die();
    // }
     ?>
    <script>changeActiveLink("contact-link");</script>
    
      
 <div class="container-fluid">
  <div class="row">
      <div class="col-lg-12 card-margin">
          <div class="card search-form">
              <div class="card-body p-0">
                      <div class="row">
                          <div class="col-12">
                              <div class="row no-gutters">
                                  <div class="col-lg-3 col-md-4 col-sm-12 p-0">
                                      <select class="form-control" id="exampleFormControlSelect1">

                                          <option>Computer Science</option>
                                          <option>Design and Art</option>
                                          <option>Economics and Management</option>
                                          <option>Education</option>
                                          <option>Science and Technology</option>
                                      </select>
                                  </div>
                                  <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                      <input type="text" placeholder="Search..." class="form-control" id="search"  name="search">
                                  </div>
                                  <div class="col-lg-1 col-md-2 col-sm-12 p-0">
                                      <button type="submit" class="btn btn-base" onclick="searchUsers()">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
          <div class="col-12">
              <div class="card card-margin">
                  <div class="card-body">
                      <div class="row search-body">
                          <div class="col-lg-12">
                              <div class="search-result" id="search-result">
                                 
                                              
                                                <?php 
                                                    include "php/contact_php/loadContactRow.php";
                                                ?>
                                          
                    
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
  

  
