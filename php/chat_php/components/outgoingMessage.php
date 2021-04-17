<?php
function createOutgoingMessage($message){
    $message_text = $message["text"];
    $message_date = $message["date"];
    $message_time = $message["time"];

    echo " <div class='outgoing_msg'> ";
    echo "      <div class='sent_msg'> ";
    echo "         <p>$message_text</p> ";
    echo "         <span class='time_date'> $message_time | $message_date</span> ";
    echo "         <p class='time' hidden>$message_time</p>";
    echo "      </div> ";
    echo " </div> ";
}
?>