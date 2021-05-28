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
            <th><button class='btn btn-primary' onclick= 'location.href=\'mailto:$professorEmail\';' > Booking </button></th>

          </tr>";
    }

?>