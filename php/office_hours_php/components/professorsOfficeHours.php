<?php
    function createProfessorsOfficeHours($professor){
        $professorEmail = $professor["mail"];
        $ProfessorOfficeHours = $professor["office_hours"];
    
    echo "<tr>
            <th scope='row'>1</th>
            <td>$professorEmail</td>
            <td>$ProfessorOfficeHours</td>
          </tr>";
    }

?>