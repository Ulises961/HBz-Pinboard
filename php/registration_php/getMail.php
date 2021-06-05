
<?php
include "credentials.php";

$mail = $_REQUEST['mail'];

$dbh = new PDO($conn_string);

$mail = filter_var($mail,FILTER_SANITIZE_EMAIL);

$sql = "SELECT * from Users WHERE mail = :mail";

$query = $dbh-> prepare($sql);
$query-> bindParam(":mail", $mail, PDO::PARAM_STR);
$query-> execute();

echo $query->rowCount();

?> 
