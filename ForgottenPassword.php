<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    
    <base href="/HBz/">

    <!-- Title Page-->
    <title>Sign Up Hedgehogs </title>

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Bootstrap core CSS -->

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <!-- Main CSS-->
    <link href="css/register_main.css" rel="stylesheet">
    <link href="css/home_main.css" rel="stylesheet">

</head>

<body>

  <?php include "navbar.php"; 
  if (isset($_SESSION['message']))
  {
      echo "<script> alert('".$_SESSION['message']."')</script>";
      unset($_SESSION['message']);
    
  }

  ?>
  <script>changeActiveLink("register-link");</script>


    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h1 class="title">Reset Password</h1>
                </div>
                <div class="card-body">
                    <form action="php/session_php/sendMail.php" method="POST">
                                      
                        <div class="form-row m-b-55">
                            <div class="name">Name*</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-6">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" id="first_name" name="first_name" required>
                                            <label for="first_name" class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" id="last_name" name="last_name" required>
                                            <label for="last_name" class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" oninput=" uniqueMail(this)" 
                                    id="email" placeholder="name@domain.com" aria-label="Email" required>
                                    <div id="mail-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <button class="btn btn--radius-2 btn--red" id="submitBtn" type="submit">Get Code</button>
                        </div>
                        <?php require_once 'php/security/form-footer.php';?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>


    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
   




</body><!-- This templates was made by Colorlib (https://colorlib.com) -->


</html>
<!-- end document-->