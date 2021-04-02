<?php

function createConversationElement($conversation_id, $conversation_name, $last_modification_date, $last_message, $img_url){
    $name = "'$conversation_name'";
    echo "<div class='chat_list active_chat' onclick=\"changeConversation($conversation_id, $name)\" >";
    echo "    <div class='chat_people'>";
    // We don't store the user's profile image right now
    echo "    <div class='chat_img'> <img src=\"$img_url\" alt='sunil'> </div>";
    echo "    <div class='chat_ib'>";
    echo "        <h5>$conversation_name<span class='chat_date'>$last_modification_date</span></h5>";
    echo "        <p>$last_message</p>";
    echo "    </div>";
    echo "    </div>";
    echo "</div>";
}

?>