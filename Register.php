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

  <?php include "navbar.php"; ?>
  <script>changeActiveLink("register-link");</script>


    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registration Form</h2>
                </div>
                <div class="card-body">
                    <form action="php/registration_php/insertUser.php" method="POST">
                                           <!-- <form action="http://10.42.0.1/HBz/response_generic.php" method="POST" target="_blank"> -->
                        <div class="form-row m-b-55">
                            <div class="name">Name*</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-6">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" required>
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name" required>
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" oninput=" uniqueMail(this)" id="email" placeholder="name@domain.com" required>
                                    <div id="mail-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row m-b-55">
                            <div class="name">Phone*</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="area_code" onkeyup="prefixCheck(this)" placeholder="+39"required>
                                            <div id="prefix-feedback"></div>
                                            <label class="label--desc">Area Code</label>
                                            
                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="phone" onkeyup="phoneCheck(this)" placeholder="1234 123456" required>
                                            <div id="phone-feedback"></div>
                                            <label class="label--desc">Phone Number</label>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Validation of password -->
                        <div class="form-row m-b-55">
                            <div class="name">Password*</div>
                            <div class="value">
                                
                                <div class="input-group-desc">
                                    <input class="input--style-5" type="password" name="pswd"
                                        id="password"
                                        onkeyup="validPswd(this)" required>
                                       
                                    <div id="pswd-feedback"></div>
                                    
                                </div>
                                <div class="d-md-table-row">
                                    <input class="d-table-cell p-t-15" type="checkbox" id=show-pswd onclick="showPswd()">
                                    <label class="d-table-cell p-t-15" label--desc">Show password</label>
                                </div>   
                            </div>
                                                         
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Repeat Password*</div>
                            <div class="value">
                                <div class="input-group-desc">
                                    <input class="input--style-5" type="password" id="password-check"
                                        onkeyup="matchesPassword(this)" required>
                                    <div id="matching-feedback"></div>
                            
                                </div>
                            </div>
                        </div>

                      
                        <!-- Student - Professor - External user -->
                        <div class="form-row m-b-55">
                            <div class="name">User*</div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select class= "custom-select" name="usertypes" id="usertypes" onchange="displayOptions(this)">
                                        <option disabled="enabled" selected="selected">Choose option</option>
                                        <option value="student">Student</option>
                                        <option value="professor">Professor</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                             
                                </div>
                            </div>
                        </div>
                        <!-- list of programs offered by the university -->
                        <div class="form-row hidden" id="study_program" style="display: none;">
                            <label class="label label--block">Select your program of studies</label>
                            <div class="p-t-15">
                                <input  type="text" name="study_programs" id="study_programs" placeholder="Eg. Computer Science" list="programs" required >
                                <datalist class="program_list" id="programs"></datalist>
                            </div>
                        </div>



                        <!-- Office Hours -->

                        <div class="form-row hidden m-b-55" id="office_hours_block">
                            <div class="name">Office hours</div>
                                <div class="value  p-t-15"">

                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="office_hours" id="office_hours" placeholder="Eg. Friday, 10:00-12:00" list="weekdays">
                                        <datalist id="weekdays">
                                            <option value="Monday"></option>
                                            <option value="Tuesday"></option>
                                            <option value="Wednesday"></option>
                                            <option value="Thursday"></option>
                                            <option value="Friday"></option>
                                        </datalist>
                                        <div id="matching-feedback"></div>
                                    </div>
                                </div>
                        </div>



                        <!-- Office -->
                        
                        <div class="form-row hidden m-b-55" id="office_block" >
                            <div class="name">Office </div>
                            <div class="value  p-t-15"">
                                <div class="input-group">
                                    <input class="input--style-5  p-t-15"" type="text" name="office" id="office" placeholder="Eg. BZ P0.00">
                                    <div id="matching-feedback"></div>
                                </div>
                            </div>
                        </div>
    

                        <!-- list of subjects a professor may teach  -->
                        <div class="form-row hidden m-b-55" id="professor_form">
                            <label class="label label--block">Select the subject(s) you are teaching at the
                                moment</label>
                            <div class="row p-t-15" id="subjects-block">
                                 <div class="col-md-8 col-xs-12">
                                    <input  type="text" name="subject-input[0]" id="subject-input" placeholder="Eg. Analysis" list="subjects" required>
                                    <datalist class="subjects_list" id="subjects"></datalist>
                                </div>
                                <div class="col">
                                    <button class="btn-secondary btn-sm btn--grey" type="button" id="addBtn"
                                        onclick="addSubjectBlock(this)">Add</button>
                                </div>
                                <div class="col">
                                    <button class=" btn-secondary  btn-sm btn--grey" type="button" style="display:none";
                                        id="deleteBtn" onclick="deleteSubjectBlock(this)">Delete</button>
                                </div>
                            </div>
                        </div>


                        <div>
                            <button class="btn btn--radius-2 btn--red" id="submitBtn" type="submit">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/registration_js/global.js"></script>





</body><!-- This templates was made by Colorlib (https://colorlib.com) -->


</html>
<!-- end document-->