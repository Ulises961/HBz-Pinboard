<?php

function createConversationElement($conversation_id, $conversation_name, $last_modification_date, $last_message, $img_url){
    $title = "'$conversation_name'";
    echo "<div class='chat_list active_chat' onclick=\"changeConversation($conversation_id, $title)\" >";
    echo "    <div class='chat_people'>";
    echo "    <div class='chat_img'> <img src=\"$img_url\" alt='sunil'> </div>";
    echo "    <div class='chat_ib'>";
    echo "        <h5>$conversation_name<span class='chat_date'>$last_modification_date</span></h5>";
    echo "        <p>$last_message</p>";
    echo "    </div>";
    echo "    </div>";
    echo "</div>";
}

?>