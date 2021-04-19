<html>

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/home_main.css">

    

</head>

    <body>

      <?php include "navbar.php"; ?>
      <script>changeActiveLink("office_hours-link");</script>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top align-items-end gradient">
            <div class="container">
              <a class="navbar-brand" href="#"><img src ="images/logo.png" alt="logo"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item" id="home-link">
                      <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <!-- <li class="nav-item" id="office_hours-link">
                      <a class="nav-link" href="office_hours.php">Office Hours</a>
                  </li> -->
                  <li class="nav-item" id="forum-link">
                      <a class="nav-link" href="forum.php">Forum</a>
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

          <header class="page-header ">
            <div class="container pt-3">
              <div class="row align-items-center justify-content-center">
                <div class="col-md-5">
      
                  <h1 class=>HBZ</h1>
      
                  <p>University platform 
                    made by students for students:
                  </p>
      
                  <ul>
                    <li>Spread ideas and knowledge</li>
                    <li>Exchange goods</li>
                    <li>Build relationships with your peers and professors</li>
                    <li>Make new friends</li>
                  </ul>

                  <button type="button" class="btn btn-outline-success btn-lg">Register</button>
                  <button type="button" class="btn btn-outline-warning btn-lg">Ask a question</button>
      
                </div>
                <div class="col-md-5">
                    <div class="image-header">
                        <img src="images/header-image.svg" alt="header-image">
                    </div>
                </div>
              </div>
            </div>
            
          </header>
        

      <section class="icons">
        <div class="container">
            <h2>Services for the community</h2>
          <div class="row text-center">
            <div class="col-md-4">
              <div class="icon gradient mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                  </svg>
                </div>
                <h3>Q/A Forum</h3>
                <p>Valuable and trustworthy information to the community.</p>
            </div>
            <div class="col-md-4">
              <div class="icon gradient mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                  </svg>
                </div>
                <h3>Chat</h3>
                <p>Real time interaction among colleagues.</p>
            </div>
            <div class="col-md-4">
              <div class="icon gradient mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                  </svg>
              </div>
                <h3>Office hours Booking</h3>
                <p>An efficient system for booking office hours with your professors.
                </p>
            </div>
          </div>
        </div>
      </section>

      <section class="feature gradient">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path
            fill="#fff"
            fill-opacity="1"
            d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,208C960,203,1056,117,1152,101.3C1248,85,1344,139,1392,165.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"
          ></path>
        </svg>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <img src="images/future-plans.png" alt="" />
            </div>
  
            <div class="col-md-6">
              <h1 class="my-3">Future Plans</h1>
              <ul>
                <li>Integration with the diverse and non linked platforms (Ki-Kero, Scub, Talila, Snow-Days, Tandem) of the is part of our long term plans.
                </li>
                <li>Users of HBz will collect a currency called Ötz coin by means of the active participation in the platform forum. Ötz coins can be exchanged for goods in the Market. This form of positive feedback-loop would promote resource sharing among the platform users.
                </li>
              </ul>
            </div>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path
            fill="#fff"
            fill-opacity="1"
            d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,208C960,203,1056,117,1152,101.3C1248,85,1344,139,1392,165.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
          ></path>
        </svg>
      </section>


        <section class="our-team">
            <h2>Meet the Team</h2>
            <div class="container">
                <div class="row">
                    <div class="container text-center">
                        <div class="row g-5">
                            <div class="col-md-3">
                            <img
                                src="images/ulises.png"
                                alt="Team photo"
                                class="img-fluid"
                            />
                            <h3>Ulises Sosa</h3>
                            <p>Backend and Founder</p>
                            </div>
                            <div class="col-md-3">
                            <img
                                src="images/balawal.png"
                                alt="Team photo"
                                class="img-fluid"
                            />
                            <h3>Sultan Balawal</h3>
                            <p>Backend and Founder</p>
                            </div>
                            <div class="col-md-3">
                            <img
                                src="images/filippo.png"
                                alt="Team photo"
                                class="img-fluid"
                            />
                            <h3>Filippo Cenacchi</h3>
                            <p>Frontend and Founder</p>
                            </div>
                            <div class="col-md-3">
                            <img
                                src="images/andres.png"
                                alt="Team photo"
                                class="img-fluid"
                            />
                            <h3>Andrés Tanesini</h3>
                            <p>Frontend and Founder</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        
            <?php include "footer.php"; ?>
            
        
    </body>

    <!--JQuery min-->
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    

</html>

