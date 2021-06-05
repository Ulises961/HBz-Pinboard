<?php

 
    function createProfessorsOfficeHours($professor){
        $professorName = $professor["name"];
        $professorSurname = $professor["surname"];
        $professorFullName = $professorName." ".$professorSurname;
        $professorOfficeHours = $professor["office_hours"];
        $professorEmail = $professor["mail"];
    
    echo "
    <div  class='office-hours-row'> 
        <div class='item'> 
            <h4>Professor's Full Name</h4>
            <h5>$professorFullName</h5>
        </div>
        <div class='item'> 
            <h4>Office Hour</h4>
            <h5>$professorOfficeHours</h5>
        </div>
        <div class='item'> 
            <h4>Email</h4>
            <h5>$professorEmail</h5>
        </div>
      
            <button class='btn btn-primary' onclick= \" location.href='mailto:$professorEmail?".
                    "subject=Booking office hours&body=Dear professor $professorSurname,".
                    "%0D%0A%0D%0AI would like to have a meeting with you to discuss about some doubts and problem I have got regarding:".
                    "%0D%0A%0D%0A---(Insert your question about the unclear topics)---". 
                    "%0D%0A%0D%0AI look forward to your answer.%0D%0A%0D%0ABest Regards,%0D%0A';\"".
                ">Booking </button>
    
    </div>
        <br>";
               
    }

?>
