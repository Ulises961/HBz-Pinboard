<?php

function createFacultyOption($faculty){
    $facultyName = $faculty["name"];
    $facultyCode = $faculty["code"];
    
    echo "<option value = '$facultyCode'>$facultyName</option>";
}
?>