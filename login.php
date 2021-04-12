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
</head>
<body>
	
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

					<form action="POST">
						<div class="wrap-input100 validate-input">
							<input class="input100" type="email" name="email" id="email" placeholder="Email">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" name="password" id="password" placeholder="Password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
					
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
						<a class="txt2" href="Registration.html">
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


</body>

</html>

<?php
// session_start(); THIS WILL STAY COMMENTED FOR NOW
include "./phpFunctions/credentials.php";
$dbh = new PDO($conn_string);

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $pswd = $_POST["password"];

    $sql =  "SELECT user_id, mail, password FROM users WHERE mail=:email";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();

    if($query->rowCount() > 0) {
        $result = $query->fetch();
        
        if (password_verify($pswd, $result['password'])) {
          $_SESSION["username"] = $_POST["username"];
          $_SESSION["user_id"] = $result["user_id"];
          exit(header("location:index.php"));
        } else {
          echo "Invalid Details";
        } 
    } else {  
        echo "Invalid Details 1";
    }  
}
?>