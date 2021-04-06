<nav class="navbar navbar-expand-lg navbar-dark bg-primary align-items-end">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" id="home-link">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item" id="office_hours-link">
                    <a class="nav-link" href="office_hours.php">Office Hours</a>
                </li>
                <li class="nav-item" id="profile-link">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item " id="contact-link">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item" id="team-link">
                    <a class="nav-link" href="team.php">Our Team</a>
                </li>
                <li class="nav-item" id="register-link">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item" id="login-link">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
function changeActiveLink(newActiveLink){
    document.getElementById(newActiveLink).className = "nav-item active";
}
</script>