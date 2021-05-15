<?php

function createUserOption($user){
    $user_id = $user["id"];
    $user_name_surname = $user["name"]." ".$user["surname"];

    echo "<option value='$user_id'>$user_name_surname</option>";
}

?>