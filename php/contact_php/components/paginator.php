<?php

    $page = $start_of_set;
    $active;

    
  

    if(intval($currentSet) >= intval($total_pages)) // WHENEVER WE ARE IN THE LAST PAGE OF RESULTS WE HIDE THE ARROW "NEXT"
        $fenabled="style='display:none'";
    else $fenabled ="style='display:block'";
    
    if(intval($start_of_set) <= 1) //WHENEVER WE ARE IN THE FIRST PAGE WE HIDE THE ARROW "PREVIOUS"
        $benabled="style='display:none'";
    else $benabled ="style='display:block'";

    echo "<ul class='pagination pagination-sm pagination-circle justify-content-center mb-0'>
                            <li $benabled>
                                <a class='page-item page-link has-icon no-border'  onclick='previousSet()'> << </a>
                            </li>

                            <li $benabled>
                                <a class='page-item page-link has-icon no-border'  onclick='previousPage()'> < </a>
                            </li>";
                         
                            while($page <= $total_pages && $page <= $currentSet ){ 
                                    if($page != $index)  // NON ACTIVE PAGES
                                        $active="";
                                    else{$active = "active"; // SHOW THE ACTIVE PAGE
                                    }
                     
                                echo " <li> <a class='page-item page-link $active' id='li-$page' onclick='selectPage($page)'>$page </a></li>";
                                $page++;
                            }

                            echo "
                            <li $fenabled>
                                <a class='page-item page-link has-icon no-border' onclick='nextPage()' $fenabled> > </a>
                                        <span class='sr-only'>Next</span>
                            </li>
                            <li $fenabled>
                                <a class='page-item page-link has-icon no-border' onclick='nextSet()' $fenabled> >> </a>
                                       
                                      <span class='sr-only'>Next</span>
                            </li>
                        </ul>";

?>