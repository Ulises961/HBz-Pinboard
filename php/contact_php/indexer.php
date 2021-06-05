<?php 

include "components/contactRow.php";

if (session_status() == PHP_SESSION_NONE) {

    session_start(['cookie_lifetime' => 43200,'cookie_secure' => true,'cookie_httponly' => true]);

}
$contacts = unserialize($_SESSION["contacts"]);
$total_contacts = count($contacts);
$total_pages = ceil($total_contacts/5);

$index = 1;


$currentSet = $_SESSION["current_set"];
$start_of_set = $currentSet-9;

if(isset($_REQUEST["page"])){
    $index = $_REQUEST["page"];

    if($index < $start_of_set)
        $currentSet -=10;
    if($index > $currentSet)
        $currentSet += 10;
}
   
elseif(isset($_REQUEST["next_set"])){
    if($_REQUEST["next_set"] === "prev"){
        $currentSet = $currentSet - 10;
        $index = $currentSet -9;
    }else{
        
        $currentSet = $currentSet + 10;
        $index = $currentSet -9;
    }
    

}
$start_of_set = $currentSet-9;
$_SESSION["current_set"] = $currentSet;

$j = $index * 5 - 5; // starts from the first element of that page

$i = $j + 5; // up to 5 questions per page

echo " 
<div class='result-header'>
<div class='row'>
    <div class='col-lg-6'>
        <div class='records'>Showing: <b>". ($j+1) ."- $i </b> of <b>$total_contacts</b> result</div>
    </div>
    
<div class='result-body'>
<div class='table-responsive'>
    <table class='table widget-26' >
    <tbody id = 'contactTableBody'>";
                                           
                                           
while($j < $i && $j < $total_contacts) {

    if( $contact = $contacts[$j])
   
     createContactRow($contact);
    $j++;
}

echo"     
        </table>
        </div>
  </tbody>
        </table>";

include "components/paginator.php";

?>