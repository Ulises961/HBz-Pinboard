<?php
echo '<h1>Forms data</h1>';
if (isset($_SERVER['REQUEST_METHOD'])) { 
   echo 'REQUEST_METHOD:    ', $_SERVER['REQUEST_METHOD'],'<br>' ; 
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST") { 
   echo '<br><br><br>','<h3>Complete list of variables from HTTP POST request</h3>';

    foreach ($_POST as $key => $value){
        echo "{$key} = {$value} <br>";
    }
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="GET") { 
    echo '<br><br><br>','<h3>Complete list of variables from HTTP GET request</h3>';

    if (isset($_SERVER['QUERY_STRING'])) { 
        echo 'QUERY_STRING:    ', $_SERVER['QUERY_STRING'],'<br>' ; 
    } 

    
    foreach ($_GET as $key => $value){
        echo "{$key} = {$value} <br>";
    }
}

?>