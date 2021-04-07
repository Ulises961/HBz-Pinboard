<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="css/team.css">
  <link rel="stylesheet" href="css/home_main.css">

</head>

<body>
  <?php include "navbar.php"; ?>
  <script>changeActiveLink("team-link");</script>

  <section>
    <div class="jumbotron">
      <h1>About HBz</h1>
      <div class="form-row m-b-55">
        <div class="col">
          <h2>The concept</h2>
          <p>

            During the last twenty years we have experienced the power of collective production.
            The most powerful tools of today's technologies were developed thanks to a fruitful interaction of peers
            from all over the world.
            It is with this spirit that we would like to propose a platform that supports the interaction and
            knowledge-sharing of university colleagues.
            It is our intention to introduce a user-friendly platform that connects all members of the Unibz community.

          </p>
        </div>
        
        <div class="col">
          <h2>Characteristics</h2>
          <p>
            Featuring a forum for the exchange of ideas and knowledge, a pinboard for the exchange of goods, and service
            of office hours of professors and an integrated chat platform 
            this platforms is the basis of interaction for the university life.
          </p>
        </div>
       
        <div class="col">
          <h2>Technologies used</h2>
          <p>
            Working with HTML, JavaScript and CSS with Bootstrap in the Front-End, while in the Back-End we have chosen to use PHP, Apache and PostgreSQL.
            For site dinamicity utilize Ajax. Furthermore we have developed a web scraper using Python to populate the database with updated and veridic information regarding the university genral information. Data encryption has been used in php to guarantee a safe storage of passwords of the users.
          </p>
        </div>
       
       
      </div>
      <br>
      <h1>Features</h1>
        <div class="form-row m-b-55">
          

          <div class="col">
            <h2>Forum</h2>
            <p>
              HBz offers a stack exchange like forum where users can ask and answer questions. 
              Helpful posts and questions can be voted, ranked accordingly and commented to give a valuable and trustworthy information to the community.
              The information can be filtered according to tags and a search bar will help to browse efficiently through the questions.
            </p>
          </div>

          <div class="col">
            <h2>Chat</h2>
            <p>
              Real time interaction among colleagues is supported by means of an integrated chat. Communication is open to all users of the platform. This feature uses the power of PostgreSQL by leveraging on JS and PHP.
              
            </p>
          </div>

          <div class="col">
            <h2>Office Hours</h2>
            <p>
              Students will be able to write to professors for the arrangement of office hours directly through the platform.
              Search filters will help students to narrow down the search for a specific professor teaching a particular subject.
            </p>
          </div>
   

        
      </div>
      <br>
        <h1>Future Plans</h1>
        <div class="form-row m-b-55">
          <div class="col">
            <h2>Platform integration</h2>
            <p>
              Integration with the diverse and non linked platforms (Ki-Kero, Scub, Talila, Snow-Days, Tandem) of the
              university is part of our long term plans.
            </p>
          </div>

          <div class="col">
            <h2>Digital Currency</h2>
            <p>
              Users of HBz will collect a currency called Ötz coin by means of the active participation in the platform forum.
              Ötz coins can be exchanged for goods in the Market. This form of positive feedback-loop would promote resource sharing among the platform users.
            </p>
          </div>

        </div>
           </div>
    </div>
  </section>

  <section id="team">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Our Team</h2>
          <div class="swiper-container team-member-slider">
            <div class="swiper-wrapper">

              <div class="swiper-slide">
                <div class="team-coverflow">
                  <div class="team-data-img">
                    <div class="team-img">
                      <img src="images/filippo.png" alt="filippo">
                      <div class="team-box-content">
                        <ul class="team-social white-bg">
                          <li><a href=""><i class="ti ti-linkedin"></i></a></li>
                          <li><a href=""><i class="ti ti-facebook"></i></a></li>
                          <li><a href=""><i class="ti ti-twitter"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="team-text">
                    <h4 class="color-black font-weight-normal 
                                            m-0 text-capitalize">Filippo Cenacchi</h4>

                    <p class="color-light-grey font-weight-light
                                             designation text-capitalize">Front-End & founder</p>
                  </div>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="team-coverflow">
                  <div class="team-data-img">
                    <div class="team-img">
                      <img src="images/andres.png" alt="Andrés Tanesini">
                      <div class="team-box-content">
                        <ul class="team-social white-bg">
                          <li><a href=""><i class="ti ti-linkedin"></i></a></li>
                          <li><a href=""><i class="ti ti-facebook"></i></a></li>
                          <li><a href=""><i class="ti ti-twitter"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="team-text">
                    <h4 class="color-black font-weight-normal 
                                            m-0 text-capitalize">Andrés Tanesini</h4>

                    <p class="color-light-grey font-weight-light
                                             designation text-capitalize">Front-End & founder</p>
                  </div>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="team-coverflow">
                  <div class="team-data-img">
                    <div class="team-img">
                      <img src="images/ulises.png" alt="Ulises Sosa">
                      <div class="team-box-content">
                        <ul class="team-social white-bg">
                          <li><a href=""><i class="ti ti-linkedin"></i></a></li>
                          <li><a href=""><i class="ti ti-facebook"></i></a></li>
                          <li><a href=""><i class="ti ti-twitter"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="team-text">
                    <h4 class="color-black font-weight-normal 
                                            m-0 text-capitalize">Ulises Sosa</h4>

                    <p class="color-light-grey font-weight-light
                                             designation text-capitalize">Back-End & founder</p>
                  </div>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="team-coverflow">
                  <div class="team-data-img">
                    <div class="team-img">
                      <img src="images/Balawal.jpg" alt="Balawal Sultan">
                      <div class="team-box-content">
                        <ul class="team-social white-bg">
                          <li><a href=""><i class="ti ti-linkedin"></i></a></li>
                          <li><a href=""><i class="ti ti-facebook"></i></a></li>
                          <li><a href=""><i class="ti ti-twitter"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="team-text">
                    <h4 class="color-black font-weight-normal 
                                            m-0 text-capitalize">Balawal Sultan</h4>

                    <p class="color-light-grey font-weight-light
                                             designation text-capitalize">Back-End & founder</p>
                  </div>
                </div>
              </div>



            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>

        </div>

      </div>
    </div>

  </section>

  <footer class="bg-light text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button"><i
            class="fab fa-facebook-f"></i></a>

        <!-- Twitter -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i
            class="fab fa-twitter"></i></a>

        <!-- Google -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39;" href="#!" role="button"><i
            class="fab fa-google"></i></a>

        <!-- Instagram -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i
            class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="#!" role="button"><i
            class="fab fa-linkedin-in"></i></a>
        <!-- Github -->
        <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i
            class="fab fa-github"></i></a>
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>






  <!--Swiper JS-->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!--JQuery min-->
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>

</body>

</html>