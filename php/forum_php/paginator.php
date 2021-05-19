<?php 



while($page <= $total_pages){
    if($page != $index)
        $active="";
    else{$active = "active";
    }
    include "components/index.php";
    
    $page++;
}


?>