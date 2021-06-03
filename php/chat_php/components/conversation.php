<?php

function createConversationElement($conversation, $isConversationPrivate){
    $conversation_id        = $conversation["id"];
    $last_message           = $conversation["last_message"];
    $conversation_name      = $conversation["name"];
    $last_modification_date = $conversation["last_change"];

    $img_url = "images/user.png";
    $title = "'$conversation_name'";

    if($isConversationPrivate){
        $conversation_name = explode(",", $conversation_name);

        if($conversation_name[0] == $_SESSION["userRow"]["name"])
            $conversation_name = $conversation_name[1];
        else
            $conversation_name = $conversation_name[0];

        $isConversationPrivate = 1;
    }
    else
        $isConversationPrivate = 0;

    echo "<div class='chat_list active_chat' onclick=\"changeConversation($conversation_id, $title, $isConversationPrivate)\" >";
    echo "    <div class='chat_people'>";
    echo "    <div class='chat_img'> <img src='$img_url' alt='Chat picture of: $conversation_name'> </div>";
    echo "    <div class='chat_ib'>";
    echo "        <h3 id='title_date$conversation_id'>$conversation_name<span class='chat_date'>$last_modification_date</span></h3>";
    echo "        <p id='last_message_$conversation_id'>$last_message</p>";
    echo "    </div>";
    echo "    </div>";
    echo "</div>";
}

?>