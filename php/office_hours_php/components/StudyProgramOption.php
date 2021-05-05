<?php

function createStudyOption($studyProgram){
    $studyProgramName = $studyProgram["name"];
    $studyProgramCode = $studyProgram["code"];
    
    echo "<option value = '$studyProgramCode'>$studyProgramName</option>";
}