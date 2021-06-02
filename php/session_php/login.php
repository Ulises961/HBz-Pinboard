<?php


include "../security/SecurityService.php";
include "../registration_php/credentials.php";

session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true, 'cookie_samesite'=>'Strict']);

if (! empty($_POST['login'])) {


    $antiCSRF = new \Phppot\SecurityService\securityService();
    try{
    $csrfResponse = $antiCSRF->validate();
    if (! empty($csrfResponse)) {
        $dbh = new PDO($conn_string);


        $email = $_POST["email"];
        $pswd = $_POST["password"];
  
            $email = filter_var($email,FILTER_SANITIZE_EMAIL);
            $pswd = filter_var($pswd,FILTER_SANITIZE_URL);

            $sql =  "SELECT id, password FROM users WHERE mail=:email";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> execute();

        
                $result = $query->fetch(PDO::FETCH_ASSOC);
            
                if ($res= password_verify($pswd, $result['password'])) {
                
                $_SESSION["user_id"] = $result["id"];
                
                exit(header("Location: ../../Forum.php"));
                } else {
                    throw new Exception('Invalid Credentials');
                } 
        }else{
            throw new Exception('Invalid Credentials');}
    }catch(Exception $e){
            
        $_SESSION["message"]= $e->getMessage();

    header("Location: ./../../Login.php");
    }
    
}
