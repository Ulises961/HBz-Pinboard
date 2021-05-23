<?php

function createConversationElement($conversation, $isConversationPrivate){
    $conversation_id        = $conversation["id"];
    $last_message           = $conversation["last_message"];
    $conversation_name      = $conversation["name"];
    $last_modification_date = $conversation["last_change"];

    $img_url = "https://ptetutorials.com/images/user-profile.png";
    $title = "'$conversation_name'";

    if($isConversationPrivate)
        $isConversationPrivate = 1;
    else
        $isConversationPrivate = 0;

    echo "<div class='chat_list active_chat' onclick=\"changeConversation($conversation_id, $title, $isConversationPrivate)\" >";
    echo "    <div class='chat_people'>";
    echo "    <div class='chat_img'> <img src='$img_url' alt='sunil'> </div>";
    echo "    <div class='chat_ib'>";
    echo "        <h5 id='title_date$conversation_id'>$conversation_name<span class='chat_date'>$last_modification_date</span></h5>";
    echo "        <p id='last_message_$conversation_id'>$last_message</p>";
    echo "    </div>";
    echo "    </div>";
    echo "</div>";
}

?>