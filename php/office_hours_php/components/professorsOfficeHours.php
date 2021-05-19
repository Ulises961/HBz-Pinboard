<?php
    function createProfessorsOfficeHours($professor){
        $professorEmail = $professor["mail"];
        $ProfessorOfficeHours = $professor["office_hours"];
    
    echo "<tr>
            <th>$professorEmail</th>
            <th>$ProfessorOfficeHours</th>
          </tr>";
    }

?>