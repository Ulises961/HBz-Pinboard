function loadProfessor(){
    let course = document.getElementById("course-select");
    $("#officeHourRow").empty();
    $.ajax({
        url: "./php/office_hours_php/loadOfficeHours.php?course=" + course.value, 
        success: function(response){
          
          $("#officeHourRow").append(response);
    
        }
      });

}

function loadStudyPrograms(){
    let faculty = document.getElementById("faculty-select");
    
    $.ajax({
        url: "./php/office_hours_php/loadStudyPrograms.php?faculty=" + faculty.value , 
        success: function(response){
            $("#course-select").empty();
            $("#study-program-select").empty();
            reinsertDefaultStudyProgram();
            reinsertDefaultCourse();
            $("#study-program-select").append(response);
    
        }
      });
}

function loadCourses(){
    let study_program = document.getElementById("study-program-select");
  
    $.ajax({
        url: "./php/office_hours_php/loadCourses.php?studyProgram=" + study_program.value , 
        success: function(response){
            $("#course-select").empty();
            reinsertDefaultCourse();
            $("#course-select").append(response);
    
        }
      });

}
function reinsertDefaultStudyProgram(){

  var defaultOption = document.createElement('option');
  defaultOption.selected=true;
  defaultOption.text="Study Program";
  $("#study-program-select").append(defaultOption);

}
function reinsertDefaultCourse(){
  var defaultOption = document.createElement('option');
  defaultOption.selected=true;
  defaultOption.text="Courses";
  $("#course-select").append(defaultOption);
}