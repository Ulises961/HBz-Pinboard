<?php

    $page = 1; 
    $active;
    
    if(intval($index) === intval($total_pages))
        $fenabled="style='display:none'";
    else $fenabled ="style='display:block'";
    
    if(intval($index) === 1)
        $benabled="style='display:none'";
    else $benabled ="style='display:block'";

    echo "<ul class='pagination pagination-sm pagination-circle justify-content-center mb-0'>
                            <li $benabled>
                                <span class='page-item page-link has-icon' onclick='previousPage()' ><i class='material-icons'>◀</i></span>
                            </li>";
                         
                            while($page <= $total_pages){
                                    if($page != $index)
                                        $active="";
                                    else{$active = "active";
                                    }
                     
                                echo " <li class='page-item page-link $active' id='li-$page' onclick='selectPage($page)'>$page</li>";
                                $page++;
                            }

                            echo "<li $fenabled>
                                <span class='page-item page-link has-icon' onclick='nextPage()' $fenabled><i
                                        class='material-icons'>▶</i></span>
                            </li>
                        </ul>";

?>