
<?php


// Connecting, selecting database

$host        = "host = localhost";
$port        = "port = 5432";
$dbname      = "dbname = hbz";
$credentials = "user = postgres password=postgres";


$dbconn = pg_connect("$host $port $dbname $credentials ")
    or die('Could not connect: ' . pg_last_error());



$name =$_POST['first_name'];
$surname=$_POST['last_name'];
$prefix=$_POST['area_code'];
$number=$_POST['phone'];
$mail=$_POST['email'];
$pswd=$_POST['pswd'];
$usertype=$_POST['usertypes'];
$program=$_POST['study_programs'];
$subjects=$_POST['subject-input'];

//testing null values on optional fields of the form

if($prefix === "" || $number === ""){
    $prefix = null;
    $number = null;
}


echo '<p>afterVariables</p>';

echo  "{$name}, {$surname }, {$prefix},{$number},{$mail},{$pswd} $program $usertype";

// Creating a user

pg_prepare($dbconn, "query", 'INSERT INTO Users Values(default,$1,$2,$3,$4,$5,$6)  RETURNING id');

$result = pg_execute($dbconn,"query",array($name,$surname,$prefix,$number,$mail,$pswd));

$row = pg_fetch_row($result);

$id=$row[0];

echo "\nid: << $id >>";


if(!$result) {
    echo pg_last_error($dbconn);
    exit;
 } else{
     echo '<p>success!</p>';
 }

 // If the user is a student it must be added to the db by selecting the program to which is enrolled

 if($usertype === "student"){
   
        pg_prepare($dbconn,"query2",'SELECT code FROM Program WHERE name= $1');
        
        $result = pg_execute($dbconn,"query2",array($program));

        if(!$result) {
            echo pg_last_error($dbconn);
            exit;
        } 

        $row = pg_fetch_row($result);
        $program_id = $row[0];
      
        pg_prepare($dbconn,"query3",'INSERT INTO Student VALUES($1,$2)');
        $result = pg_execute($dbconn,"query3",array($id,$program_id));

        if(!$result) {
            echo pg_last_error($dbconn);
            exit;
        } 
        
      

    }

if($usertype === "professor"){

    

}

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);


?> 
