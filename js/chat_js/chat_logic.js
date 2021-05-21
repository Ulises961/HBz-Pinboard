var update_interval = 2500; // this is the update frequency
var chat_update_timeout; // this is the variable on which the timeout function is called
var conversation_update_timeout; // this is the variable on which the timeout function is called
var user = 1; // this is the id of the currently logged user, it must be changed in the future


// THIS FUNCTION IS CALLED WHEN THE USER CHANGES CONVERSATION
// AND IT STARTS LOADING THE MESSAGES BELONGING TO THAT CONVERSATION
function changeConversation(id, title, isPrivate) {
  document.getElementById("conversationTitle").innerText = title;
  document.getElementById("msg_send_btn").value = id;
  document.getElementById("msg_history").innerHTML = '';
  $("#msg_history").show();
  $("#chat-menu").hide();
  if(isPrivate == 1)
    document.getElementById("isCovnersationPrivate").value = 1;
  else
    document.getElementById("isCovnersationPrivate").value = 0;

  clearTimeout(chat_update_timeout); // stops updating the previous conversation
  loadChat(id, isPrivate);
}

// THIS FUNCTION IS CALLED WHEN THE USER PRESSES THE SEND MESSAGE BUTTON
// AND THE FUNCTION MAKES AN AJAX CALL TO A PHP SCRIPT THAT INSERTS THE MESSAGE INTO THE DB
function sendMessage() {
  var isConversationPrivate = document.getElementById("isCovnersationPrivate").value;
  var conversation = document.getElementById("msg_send_btn").value;
  var message_text = document.getElementById("inputMessage").value;

  var parameters = "conversation=" + conversation + "&message=" 
                   + message_text + "&isPrivate=" + isConversationPrivate;

  $.ajax({
    url: "./php/chat_php/sendMessage.php?" + parameters, 
    success: function(response){
      console.log(response);
      document.getElementById("inputMessage").value = " "; // empties the message input field
    }
  });

}

// THIS FUNCTION LOADS THE OLD MESSAGES BELONGING TO A CONVERSATION
function loadChat(conversation, isConversationPrivate) {
  var parameters = "conversation=" + conversation + "&isPrivate=" + isConversationPrivate;

  $.ajax({
    url: "./php/chat_php/loadChat.php?" + parameters, 
    success: function(response){
      $("#msg_history").append(response);
      scrollToLastMessage();

      var lastMessageTime = $(".time").last().text();
      updateChat(conversation, lastMessageTime, isConversationPrivate);
    }
  });
}

// THIS FUNCTION KEEPS THE CHAT UPDATED AND EVERY 2.5 SECONDS CHECKS FOR NEW MESSAGES
function updateChat(conversation, lastMessageTime, isConversationPrivate) {
  var parameters = "conversation=" + conversation + "&time=" + lastMessageTime + "&isPrivate=" + isConversationPrivate;

  $.ajax({
    url: "./php/chat_php/updateChat.php?" + parameters, 
    success: function(response){
      
      if(response != ""){
        $("#msg_history").append(response);
        lastMessageTime = $(".time").last().text();
        scrollToLastMessage();
      }

      chat_update_timeout = setTimeout(function () {
        updateChat(conversation, lastMessageTime, isConversationPrivate); 
      }, update_interval);
    }
  });
}

// THIS FUNCTION KEEPS THE CONVERSATIONS UPDATED AND EVERY 2.5 SECONDS CHECKS FOR NEW MESSAGES
function updateConversations() {
  $.ajax({
    url: "./php/chat_php/updateConversations.php", 
    success: function(response){
      var conversations = JSON.parse(response);

      conversations.forEach(conversation => {
        updateConversationPreview(conversation);
      });

      conversation_update_timeout = setTimeout(function () {
        updateConversations(); 
      }, update_interval);
    }
  });
}

function updateConversationPreview(json_conversation) {
  var conversation = JSON.parse(json_conversation);

  document.getElementById("title_date" + conversation.id)
          .innerHTML = "<h5 id='title_date" + conversation.id + "'>" + conversation.name + 
                       "<span class='chat_date'>" + conversation.last_change + "</span></h5>";

  document.getElementById("last_message_" + conversation.id)
          .innerText = conversation.last_message;
}

// THIS FUNCTION LOADS THE BLOCKS A CONVERSATION
function blockConversation() {
  var conversation = document.getElementById("msg_send_btn").value;
  var parameters = "conversation=" + conversation;

  $.ajax({
    url: "./php/chat_php/changeConversationStatus.php?" + parameters, 
    success: function(response){
      console.log(response);
    }

  });
}

function leaveConversation() {
  var conversation = document.getElementById("msg_send_btn").value;
  var parameters = "conversation=" + conversation + "&user=" + user;

  $.ajax({
    url: "./php/chat_php/leaveConversation.php?" + parameters, 
    success: function(response){
      console.log(response);
    }

  });
}

function kickUser(targetUser) {
  var conversation = document.getElementById("msg_send_btn").value;
  var parameters = "conversation=" + conversation + "&user=" + targetUser;

  $.ajax({
    url: "./php/chat_php/kickUserFromConversation.php?" + parameters, 
    success: function(response){
      updateConversationUsers(conversation);
    }
  });
}

// THIS FUNCTION TOGGLES BETWEEN THE CHAT AND THE CHAT-MENU
function toggleMenu() {
  var isConversationPrivate = document.getElementById("isCovnersationPrivate").value;
  var conversation = document.getElementById("msg_send_btn").value;
  var isChatVisible = document.
                      getElementById('msg_history').
                      style.display;

  if(isChatVisible == 'none') {
    $("#msg_history").show();
    $("#chat-menu").hide();
    
  }else if(conversation != "empty"){
    $("#msg_history").hide();

    if(isConversationPrivate == 1)
      loadPrivateMenu();
    else
      loadGroupMenu(conversation);
  }
}

function loadGroupMenu(conversation){
  $.ajax({
    url: "./php/chat_php/groupMenu.php", 
    success: function(response){
      $("#chat-menu").empty();
      $("#chat-menu").append(response);
      updateConversationUsers(conversation);
      $("#chat-menu").show();
    }
  });
}

function loadPrivateMenu(){
  $.ajax({
    url: "./php/chat_php/privateMenu.php", 
    success: function(response){
      $("#chat-menu").empty();
      $("#chat-menu").append(response);
      $("#chat-menu").show();
    }
  });
}

function updateConversationUsers(conversation){
  $.ajax({
    url: "./php/chat_php/loadConversationUsers.php?conversation=" + conversation, 
    success: function(response){
      $("#conversationUsers").empty();
      $("#conversationUsers").append(response);
    }
  });
}

function addUserToConversation() {
  var conversation = document.getElementById("msg_send_btn").value;
  var new_user = document.getElementById("user-list").value;
  var parameters = "conversation=" + conversation + "&newUser=" + new_user;

  $.ajax({
    url: "./php/chat_php/addUserToConversation.php?" + parameters, 
    success: function(response){
      $("#user-list").empty();
      updateConversationUsers(conversation);
    }
  });
}

function updateAvailableUsers(){
  var conversation = document.getElementById("msg_send_btn").value;
  var searchTerm = document.getElementById("user-search").value;
  var parameters = "conversation=" + conversation + "&searchTerm=" + searchTerm;

  $.ajax({
    url: "./php/chat_php/loadAvailableUsers.php?" + parameters, 
    success: function(response){
      $("#user-list").empty();
      $("#user-list").append(response);      
    }
  });
}

function scrollToLastMessage() {
  $("#msg_history").animate({
    scrollTop: $("#msg_history")[0].scrollHeight
  }, 1000);
}