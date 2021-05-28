<?php
    function createProfessorsOfficeHours($professor){
        $professorName = $professor["name"];
        $professorSurname = $professor["surname"];
        $professorFullName = $professorName." ".$professorSurname;
        $professorOfficeHours = $professor["office_hours"];
        $professorEmail = $professor["mail"];
    
    echo "<tr>
            <th>$professorFullName</th>
            <th>$professorOfficeHours</th>
            <th>$professorEmail</th>
            <th><button class='btn btn-primary' onclick= \" location.href='mailto:$professorEmail?subject=Booking office hours&body=Dear professor $professorSurname,  I would like to have a meeting with you to discuss about some doubts and problem I have got regarding: (insert your question about the unclear topics).';\" > Booking </button></th>

          </tr>";
    }

?>