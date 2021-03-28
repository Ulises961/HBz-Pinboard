<?php

echo '<h1>Forms data</h1>';
if (isset($_SERVER['REQUEST_METHOD'])) { 
   echo 'REQUEST METHOD:    ', $_SERVER['REQUEST_METHOD'],'<hr>' ; 
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST") { 
   echo '<br><br><br>','<h3>Complete list of variables from HTTP POST request</h3>';

    foreach ($_POST as $key => $value){
        echo "{$key} = {$value} <br>";
    }
}


?>