<?php

function createMenuUserRow($user, $currentUserIsAdmin){
    $user_id = $user["id"];
    $user_name_surname = $user["name"]." ".$user["surname"];
    $userIsAdmin = $user["isadmin"];

    $makeAdminOption = "<div class='col-2' onclick='makeUserIntoAdmin($user_id)'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-person-plus-fill' viewBox='0 0 16 16'>
                                <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
                                <path fill-rule='evenodd' d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z'/>
                            </svg>
                        </div>";

    $kickUserOption =  "<div class='col-2' onclick='kickUser($user_id)'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-x-octagon-fill' viewBox='0 0 16 16'>
                                <path d='M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>
                            </svg>
                        </div>";

    $emptyDiv = "<div class='col-2'></div>";


    echo "<div class='row' id='menu-user-$user_id'>
        <div class='col-8'>$user_name_surname</div>";
        
    if($userIsAdmin == false && $currentUserIsAdmin)
        echo $makeAdminOption;
    else
        echo $emptyDiv;


    if($userIsAdmin == false && $currentUserIsAdmin)
        echo $kickUserOption;
    else
        echo $emptyDiv;

    echo "</div>";
}

?>