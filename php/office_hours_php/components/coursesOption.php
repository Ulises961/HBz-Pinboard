<?php

function createCourseOption($course){
    $CourseName = $course["name"];
    $CourseCode = $course["id"];
    
    echo "<option value = '$CourseCode'>$CourseName</option>";
}
?>