
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
$pswd= password_hash($_POST["pswd"], PASSWORD_ARGON2I);
$usertype=$_POST['usertypes'];
$program=$_POST['study_programs'];
$subjects=$_POST['subject-input'];
$office=$_POST['office'];
$office_hours=$_POST['office_hours'];
echo "$subjects[0]";
//testing null values on optional fields of the form

if($prefix === "" || $number === ""){
    $prefix = null;
    $number = null;
}


echo '<p>afterVariables</p>';

echo  "{$name}, {$surname }, {$prefix},{$number},{$mail},{$pswd} $program $usertype\n";

// Creating a user

pg_prepare($dbconn, "userInsertion", 'INSERT INTO Users Values(default,$1,$2,$3,$4,$5,$6)  RETURNING id');

$result = pg_execute($dbconn,"userInsertion",array($name,$surname,$prefix,$number,$mail,$pswd));

$row = pg_fetch_row($result);

$id= intval($row[0]);

echo "\nid: << $id >>";


if(!$result) {
    echo pg_last_error($dbconn);
    exit;
 } else{
     echo '<p>success!</p>';
 }

 // If the user is a student it must be added to the db by selecting the program to which is enrolled

 if($usertype === "student"){
   
        pg_prepare($dbconn,"selectProgram",'SELECT code FROM Program WHERE name= $1');
        
        $result = pg_execute($dbconn,"selectProgram",array($program));

       
        $row = pg_fetch_row($result);
        $program_id = $row[0];
      
        pg_prepare($dbconn,"studentInsertion",'INSERT INTO Student VALUES($1,$2)');
        $result = pg_execute($dbconn,"studentInsertion",array($id,$program_id));

        if(!$result) {
            echo pg_last_error($dbconn);
            exit;
        } 
        
      

    }

else if($usertype === "professor"){

       
    pg_prepare($dbconn,"insertProfessor",'INSERT INTO Professor VALUES($1,$2,$3)');
    $result = pg_execute($dbconn,"insertProfessor",array($id,$office_hours,$office));

    if(!$result) {
        echo "error while inserting professor tuple" . pg_last_error($dbconn);
        exit;
    } 
    
    foreach($subjects as $index => $subject){

       
        pg_prepare($dbconn,"selectSubject",'SELECT id FROM Subject WHERE name= $1');
       
        $result = pg_execute($dbconn,"selectSubject",array($subject));
        $row = pg_fetch_row($result);
        $subject = $row[0];
        echo "id variable is: $id and subject id is: $subject\n";

        pg_prepare($dbconn,"teaches",'INSERT INTO Teaches VALUES($1,$2)');
        $result = pg_execute($dbconn,"teaches",array($id,$subject));
        echo "\nsubject id is: $subjext";
        if(!$result) {
            echo pg_last_error($dbconn);
            exit;
        } 
        
    }

}

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);


?> 
