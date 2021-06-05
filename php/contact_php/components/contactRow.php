

<?php
function createContactRow($user){
    $id = $user["id"];
    $name = $user["name"];
    $surname = $user["surname"];
    $email = $user["mail"];
    $picture = $user["picture"];
    
    echo "<tr>
            <td>
                <div class='widget-26-job-emp-img'>
                    <img src=$picture alt='Company' width='50px'/>
                </div>
            </td>
            <td>
                <div class='widget-26-job-info'>
                    <p class='type m-0'>$name $surname</p>
                </div>
            </td>
            <td>
                <div class='widget-26-job-salary'>
                <p class='type m-0'>$email</p>
                </div>
            </td>
            <td>
                <div class='widget-26-job-starred'>
                    <button type='button' class='btn custom-btn'>
                        <a href='Profile.php?user=$id'>Show profile</a>
                    </button>
                </div>
            </td>
        </tr>";
}


?>
