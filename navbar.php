<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top align-items-end gradient mb-5">
            <div class="container">
              <a class="navbar-brand" href="index.php"><img src ="images/logo.png" alt="logo"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item" id="home-link">
                      <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item" id="office_hours-link">
                      <a class="nav-link" href="Office_hours.php">Office Hours</a>
                  </li>
                  <li class="nav-item" id="forum-link">
                      <a class="nav-link" href="Forum.php">Forum</a>
                  </li>
                  <li class="nav-item" id="profile-link">
                      <a class="nav-link" href="Profile.php">Profile</a>
                  </li>
                  <li class="nav-item " id="contact-link">
                      <a class="nav-link" href="Contact.php">Contact</a>
                  </li>
                  <li class="nav-item" id="login-link">
                      <a class="nav-link" href="php/session_php/logout.php">Chat</a>
                  </li>
                  <li class="nav-item" id="chat">
                      <a class="nav-link" href="Chat.php">Log Out</a>
                  </li>
              </ul>
              </div>
            </div>
</nav>




<!-- DO NOT CHANGE THE SCRIPT -->
<script>
function changeActiveLink(newActiveLink){
    document.getElementById(newActiveLink).className = "nav-item active";
}
</script>