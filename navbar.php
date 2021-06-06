<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top align-items-end gradient mb-5">
            <div class="container">
              <a class="navbar-brand" href="Forum.php"><img src ="images/logo.png" alt="Hbz logo"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item" id="home-link">
                      <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item " id="login-link">
                      <a class="nav-link" href="Login.php">Login</a>
                  </li>
                  <li class="nav-item" id="register-link">
                      <a class="nav-link" href= "Register.php" >Register</a>
                  </li>
              </ul>
              </div>
            </div>
</nav>

<?php if(session_status() == PHP_SESSION_NONE)
  session_start(['cookie_lifetime' => 43200,'cookie_secure' => false,'cookie_httponly' => true, 'cookie_samesite'=>'Strict']); 

 

?>


<!-- DO NOT CHANGE THE SCRIPT -->
<script>
function changeActiveLink(newActiveLink){
    document.getElementById(newActiveLink).className = "nav-item active";
}
</script>