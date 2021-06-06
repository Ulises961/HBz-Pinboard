<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top align-items-end gradient mb-5">
            <div class="container">
              <img src ="images/logo.png" alt="Hbz-logo"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>&#10240
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item" id="forum-link">
                      <a class="nav-link" href="Forum.php">Forum</a>
                  </li>
                  <li class="nav-item" id="office_hours-link">
                      <a class="nav-link" href="Office_hours.php">Office Hours</a>
                  </li>
                  <li class="nav-item " id="chat-link">
                      <a class="nav-link" href="Chat.php">Chat</a>
                  </li>
                  <li class="nav-item" id="profile-link">
                      <a class="nav-link" href="Profile.php">Profile</a>
                  </li>
                  <li class="nav-item" id="contact-link">
                      <a class="nav-link" href="Contact.php">Contacts</a>
                  </li>
                  <li class="nav-item" id="logout">
                      <a class="nav-link" href="php/session_php/logout.php">Logout</a>
                  </li>
              </ul>
              </div>
            </div>
</nav>

<?php if(session_status() == PHP_SESSION_NONE)
    session_start(['cookie_lifetime' => 43200,'cookie_secure' => false,'cookie_httponly' => true, 'cookie_samesite'=>'Strict']); ?>


<!-- DO NOT CHANGE THE SCRIPT -->
<script>
function changeActiveLink(newActiveLink){
    document.getElementById(newActiveLink).className = "nav-item active";
}
</script>