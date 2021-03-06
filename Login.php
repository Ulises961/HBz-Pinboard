<!DOCTYPE html>
<html lang="en">
<head>
	<title>HBZ</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/Loginutil.css">
	<link rel="stylesheet" type="text/css" href="css/Loginmain.css">
<!--===============================================================================================-->

<!-- footer css -->
<link href="css/home_main.css" rel="stylesheet">
<!-- / footer css -->
</head>

<body>
<?php include 'navbar.php';

if (isset($_SESSION['message']))
{
    echo "<script>alert('".$_SESSION['message']."')</script>";
    unset($_SESSION['message']);
	
}

 ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/riccio.jpeg" alt="Riccio">
				</div>

				<!-- CHANGE DIV TO FORM -->
				<div class="login100-form validate-form">
					<span class="login100-form-title">
						Member Login
					</span>

					<form action="php/session_php/login.php" method="POST" enctype="multipart/form-data" target="_self">
						<div class="wrap-input100 validate-input">
							<input class="input100" type="email" name="email" id="email" placeholder="Email" aria-label="Insert email" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
							<input class="input100" type="password" name="password" id="password" placeholder="Password" aria-label="Insert password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
							<div class='d-md-table-row'>
                            <input class='d-table-cell p-t-15' type='checkbox' id=show-pswd onclick='showPswd()'aria-label="Show password">
                            <label class='d-table-cell p-t-15' label--desc'>Show password</label>
                        </div>   
						</div>

						<div id="login-feedback"></div>
					
						<div class="container-login100-form-btn">
							<input class="login100-form-btn" type="submit" name="login" value="Login"/>
							
						</div>
						<?php require_once 'php/security/form-footer.php';?>
					</form>

					<div class="text-center p-t-12">
						
						
				
						<a class="txt2" href="ForgottenPassword.php">
							<h5>Forgot your Password?</h5>
						</a>
						<br>
				
							
						<a class="txt2" href="Register.php">
							<h5>Create your Account</h5>
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>

						</a>
				
				
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
    
	 
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/registration_js/global.js"></script>
<!--===============================================================================================-->
<?php include 'footer.php'; ?>
            

</body>

</html>

