<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/phpmailer/src/SMTP.php';
require_once  __DIR__ . '/../../../mailCredentials.php';
include '../credentials.php';

require_once '../security/SecurityService.php';



$antiCSRF = new \Phppot\SecurityService\securityService();
$csrfResponse = $antiCSRF->validate();
try{
  if (! empty($csrfResponse)) {

    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);

    $dbh = new PDO($conn_string);
    $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $userMail= filter_var( $_REQUEST["email"],FILTER_SANITIZE_EMAIL);
    $firstName = filter_var( $_REQUEST["first_name"],FILTER_SANITIZE_STRING);
    $lastName = filter_var( $_REQUEST["last_name"],FILTER_SANITIZE_STRING);
    $code = random_int(100001,999999);


      $update =  "UPDATE users SET oneTimeCode =:code, recoveryMode=TRUE";
      $where= " WHERE mail=:email AND name=:name AND surname=:lastname RETURNING recoveryMode";
      $sql = $update.$where;
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':code', $code, PDO::PARAM_STR);
      $query-> bindParam(':email', $userMail, PDO::PARAM_STR);
      $query-> bindParam(':name', $firstName, PDO::PARAM_STR);
      $query-> bindParam(':lastname', $lastName, PDO::PARAM_STR);
      
      $query-> execute();

      $result = $query -> fetch(PDO::FETCH_ASSOC);
      if ($result["recoverymode"] !== true){ 
      
      throw new Exception("Invalid Credentials ");
      }
      // Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->Username = $username ; // sender user email
      $mail->Password = $senderMailPassword; // sender user password

      // Sender and recipient settings
      $mail->setFrom('no-reply@hbz.com', 'HBz.com');
      $mail->addAddress($userMail, $firstName);
      $mail->addReplyTo('no-reply@hbz.com', 'No Reply'); // to set the reply to

      // Setting the email content
      $mail->IsHTML(true);
      $mail->Subject = "One Time Code";
      $mail->Body = "Hi ". $firstName.", <br><br>Your one time code to reset the password is $code<br><br> Best Regards, <br><br> The HBz Team ";
      $mail->AltBody = "Hi ". $firstName." <br> Your one time code to reset the password is $code<br><br> Best Regards,<br><br> The HBz Team ";

      $mail->send();

      $_SESSION["message"] = "A code was sent to the email provided";
      header("Location: ./../../ResetPassword.php?mail=$userMail");
    }else{
      
      throw new Exception("Invalid Operation");
    }
  } catch (Exception $e) {
    
    $_SESSION["message"] = $e->getMessage(); 
    header("Location: ./../../ForgottenPassword.php");
}

?>
