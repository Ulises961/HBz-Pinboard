
<?php

include "credentials.php";
include "../Utils.php";



$name =$_REQUEST['first_name'];
$surname=$_REQUEST['last_name'];
$prefix=$_REQUEST['area_code'];
$number=$_REQUEST['phone'];
$mail=$_REQUEST['email'];
$pswd= password_hash($_REQUEST["pswd"], PASSWORD_ARGON2I);
$usertype=$_REQUEST['usertypes'];


$dbh = new PDO($conn_string);

if($prefix === "" || $number === ""){
    $prefix = null;
    $number = null;
}else{
    $number = filter_var($number,FILTER_SANITIZE_NUMBER_INT);
    $prefix = filter_var($prefix,FILTER_SANITIZE_NUMBER_INT);
}
try{

    $mail = filter_var($mail,FILTER_SANITIZE_EMAIL);
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $surname = filter_var($surname,FILTER_SANITIZE_STRING);
    $pswd = filter_var($pswd,FILTER_SANITIZE_STRING);
    


    $insertInto= "INSERT INTO Users(id, name, surname, prefix, number, mail, password) ";
    $values= "VALUES (default, :name, :surname, :prefix,:number, :mail, :pswd) ";

    $sql = $insertInto.$values;

    $insert = $dbh-> prepare($sql);

    $insert-> bindParam(":name",$name,PDO::PARAM_STR);
    $insert-> bindParam(":surname",$surname,PDO::PARAM_STR);
    $insert-> bindParam(":prefix",$prefix,PDO::PARAM_STR);
    $insert-> bindParam(":number",$number,PDO::PARAM_STR);
    $insert-> bindParam(":mail",$mail,PDO::PARAM_STR);
    $insert-> bindParam(":pswd",$pswd,PDO::PARAM_STR);

    $insert-> execute();


    $id = $dbh->lastInsertId();

    alert($id);

    if($usertype === "student"){

            $program=$_REQUEST['study_programs'];

            $selectProgram = "SELECT code FROM Program WHERE name= :program";

            $query = $dbh-> prepare($selectProgram);
            
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);

                
            $program_id = $row[0];
            
            $insertStudent= "INSERT INTO Student (id,program) VALUES (:id, :program) ";

            $insertion = $dbh->prepare($insertStudent);
            $insertion-> bindParam(":id", intval($id),PDO::PARAM_INT);          
        
            exit(header("Location: ./../../login.php"));
            }

    elseif($usertype === "professor"){

            $subjects=$_REQUEST['subject-input'];
            $office=$_REQUEST['office'];
            $office_hours=$_REQUEST['office_hours'];
            

            //testing null values on optional fields of the form

            $insertProfessor = 'INSERT INTO Professor (id,office_hours,office) VALUES(:id,:office_hours,:office)';
        
            $insertion = $dbh -> prepare($insertProfessor);
            $insertion-> bindParam(":id",intval($id),PDO::PARAM_INT);
            $insertion -> bindParam(":office_hours", $office_hours,PDO::PARAM_STR);
            $insertion -> bindParam(":office",$office, PDO::PARAM_STR);

            $insertion -> execute();

            
            foreach($subjects as $index => $subject){
        
                $selectSubjectId = "SELECT id FROM Subject WHERE name=:subject";
                $subjectSelection = $dbh -> prepare($selectSubjectId);
                $subjectSelection -> bindParam(":subject", $subject,PDO::PARAM_STR);
                $subjectSelection -> execute();
                $row = $subjectSelection -> fetch(PDO::FETCH_ASSOC);
                $result = $row[0];
                
                
                
                $insertionString= "INSERT INTO Teaches (professor,subject) VALUES(:professor,:result)";
                $insertTeaches = $dbh -> prepare($insertionString); 
                $insertTeaches -> bindParam(":professor",intval($id),PDO::PARAM_INT);
                $insertTeaches -> bindParam(":result", intval($subject),PDO::PARAM_INT);
                $insertTeaches -> execute();

            
                exit(header("Location: ./../../login.php"));
            }
        }
}catch(Exception $e){
        alert($e);
        die();
    }


?> 