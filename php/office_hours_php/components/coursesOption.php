<?php

function createCourseOption($course){
    $CourseName = $course["name"];
    $CourseCode = $course["code"];
    
    echo "<option value = '$CourseCode'>$CourseName</option>";
}