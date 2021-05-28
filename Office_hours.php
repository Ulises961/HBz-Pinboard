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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!-- Load the logic for the page -->
  <script src="js/office_hours_js/office_hours_logic.js"> </script>

  <title>Office hours</title>
</head>

<body>

  <?php include "navbar2.php"; ?>
  <script>
    changeActiveLink("office_hours-link");
  </script>

  <header class="office-hours-form">

    <h1>Office Hours Booking</h1>

    <div class="sel-forms-office">
      <select id="faculty-select" onchange="loadStudyPrograms()" class="form-select" aria-label="Default select example">
        <option selected>Select Faculty</option>
        <?php include "php/office_hours_php/loadFaculties.php" ?>
      </select>
      <select id="study-program-select" onchange="loadCourses()" class="form-select" aria-label="Default select example">
        <option selected>Study Program</option>

      </select>
      <select id="course-select"  class="form-select" aria-label="Default select example">
        <option selected>Courses</option>

      </select>
    </div>

    <button class="btn btn-primary" onclick="loadProfessor()">Search</button>

    <table id="officeHoursTable" class="table">
      <thead>
        <tr>
          <th scope="col">Professor's Full Name</th>
          <th scope="col">Office Hour</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody id="officeHourRow">
     
      
      </tbody>
    </table>

  </header>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</body>

</html>