<?php
session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true, 'cookie_samesite'=>'Strict']); 

 
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
            <th><button class='btn btn-primary' onclick= \" location.href='mailto:$professorEmail?
                    subject=Booking office hours&body=Dear professor $professorSurname,
                    %0D%0AI would like to have a meeting with you to discuss about some doubts and problem I have got regarding:
                    %0D%0A%0D%0A(Insert your question about the unclear topics). 
                    I look forward to your answer.%0D%0ABest Regards,%0D%0A'".$_SESSION["user_name"].";\"
                > Booking </button></th>

          </tr>";
    }

?>