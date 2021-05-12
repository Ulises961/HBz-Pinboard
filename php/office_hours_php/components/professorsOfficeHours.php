<?php
    function createProfessorsOfficeHours($professor){
        $professorEmail = $professor["mail"];
        $ProfessorOfficeHours = $professor["office_hours"];
    
    echo "<tr>
            <td>$professorEmail</td>
            <td>$ProfessorOfficeHours</td>
          </tr>";
    }

?>