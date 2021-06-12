<?php
function createIncomingMessage($message){
    var_dump($message);
    $message_text = $message["text"];
    $message_date = $message["date"];
    $message_time = $message["time"];
    $sender_name = $message["sendername"];
    $sender_picture = $message["senderpicture"];

    echo " <div class='incoming_msg'> ";
    echo "      <div class='incoming_msg_img'> ";
    echo "          <img src='$sender_picture' alt='$sender_name'> ";
    echo "      </div> ";
    echo "      <div class='received_msg'> ";
    echo "          <div class='received_withd_msg'> ";
    echo "              <p>$message_text</p> ";
    echo "              <span class='time_date'>From $sender_name on $message_time | $message_date</span> ";
    echo "              <p class='time' hidden>$message_time</p>";
    echo "          </div> ";
    echo "      </div> ";
    echo " </div> ";
}
?>