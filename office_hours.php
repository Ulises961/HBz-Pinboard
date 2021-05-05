
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/office_hours.css" rel="stylesheet">
    <link href="css/home_main.css" rel="stylesheet">

    <title>Office hours</title>
  </head>

  <body>

    <?php include "navbar.php"; ?>
    <script>changeActiveLink("office-hours-link");</script>

    <header class="office-hours-form">
     
      <h1>Office Hours Booking</h1>

      <div class="sel-forms-office">
        <select class="form-select" aria-label="Default select example">
          <option selected>Select Faculty</option>
          <?php include "php/office_hours_php/getFaculties.php" ?>
        </select>
        <select class="form-select" aria-label="Default select example">
            <option selected>Study Program</option>
            <?php include "php/office_hours_php/getStudyProgram.php" ?>
        </select>
        <select class="form-select" aria-label="Default select example">
            <option selected>Courses</option>
            <?php include "php/office_hours_php/getCourses.php" ?>
        </select>
      </div>

      <button class="btn btn-primary" type="submit">Search</button>

    </header>
      
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


  </body>
</html>



            
                
                    
            
                        

  
