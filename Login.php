<!DOCTYPE html>
<html lang="en">
<head>
	<title>HBZ</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/Loginutil.css">
	<link rel="stylesheet" type="text/css" href="css/Loginmain.css">
<!--===============================================================================================-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- footer css -->
<link href="css/home_main.css" rel="stylesheet">
<!-- / footer css -->
</head>

<body>
<?php include 'navbar.php'; ?>
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

					<form action="php/session_php/login.php" method="POST" target="_self">
						<div class="wrap-input100 validate-input">
							<input class="input100" type="email" name="email" id="email" placeholder="Email" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
							<input class="input100" type="password" name="password" id="password" placeholder="Password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>

						<div id="login-feedback"></div>
					
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="submit" name="login">
								Login
							</button>
						</div>
					</form>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="Register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
    
	 
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<?php include 'footer.php'; ?>
            

</body>

</html>
