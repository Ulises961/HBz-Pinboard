import {createIncomingMessage} from './js_elements/incoming_message.js';
import {createOutgoingMessage} from './js_elements/outgoing_message.js';

var chatUpdateInterval;
var user = 1;

function sendMessage() {
  var message_text = document.getElementById("inputMessage").value;
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };

  var conversation = document.getElementById("sendMessageBtn").value;
  var parameters = "conversation=" + conversation + "&message=" + message_text + "&user=" + user;

  xmlhttp.open("GET", "./sendMessage.php?" + parameters, true);
  xmlhttp.send();
}

function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

function showConversations() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      console.log(this.responseText);
      if (isJson(this.responseText)) {
        var conversations = JSON.parse(this.responseText);

        conversations.forEach(object => {
          var listItem = document.createElement("li");
          var conversation = JSON.parse(object);
          console.log(object);

          listItem.id = conversation.id;
          listItem.innerText = conversation.name;
          listItem.onclick = function () { changeConversation(conversation.id, conversation.name); };

          document.getElementById("users").appendChild(listItem);
        });
      }
    }
  };

  xmlhttp.open("GET", "./getConversations.php?user=" + user, true);
  xmlhttp.send();
}

// showConversations();

function loadConversation(conversation) {
  clearTimeout(chatUpdateInterval);
  document.getElementById("msg_history").innerHTML = '';
  var xmlhttp = new XMLHttpRequest();
  var lastMessageTime;

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      
      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(json_message => {
          var message = JSON.parse(json_message);
          var message_element = null;

          if(message.users == user)
            message_element = createOutgoingMessage(message);
          else
            message_element = createIncomingMessage(message);

          lastMessageTime = message.time;
          
          document.getElementById("msg_history").appendChild(message_element);
          message_element.scrollIntoView();
        });

      }else{
        console.log(this.responseText);
      }

      updateConversation(conversation, lastMessageTime);
    }
  };

  xmlhttp.open("GET", "./loadConversation.php?conversation=" + conversation, true);
  xmlhttp.send();
}

function changeConversation(id, title) {
  document.getElementById("conversationTitle").innerText = title;
  document.getElementById("msg_send_btn").value = id;
  loadConversation(id);
}

function updateConversation(conversation, lastMessageTime) {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(json_message => {
          var message = JSON.parse(json_message);
          var message_element = null;

          if(message.users == user)
            message_element = createOutgoingMessage(message);
          else
            message_element = createIncomingMessage(message);

          lastMessageTime = message.time;
          console.log(message.time);

          document.getElementById("msg_history").appendChild(message_element);
          message_element.scrollIntoView();
        });

      }else{
        console.log(this.responseText);
      }

    }
  };

  var parameters = "conversation=" + conversation + "&time=" + lastMessageTime;

  xmlhttp.open("GET", "./updateConversation.php?" + parameters, true);
  xmlhttp.send();

  chatUpdateInterval = setTimeout(function () { updateConversation(conversation, lastMessageTime); }, 2500);
}
