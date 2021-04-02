// import {createIncomingMessage} from './js_elements/incoming_message.js';
// import {createOutgoingMessage} from './js_elements/outgoing_message.js';

function changeConversation(id, title) {
  console.log("aadasdasasdsad");
  document.getElementById("conversationTitle").innerText = title;
  document.getElementById("msg_send_btn").value = id;
  loadConversation(id);
}

function createIncomingMessage(message) {
  var incoming_msg       = document.createElement("div");
  var incoming_msg_img   = document.createElement("div");
  var img                = document.createElement("img");
  var received_msg       = document.createElement("div");
  var received_withd_msg = document.createElement("div");
  var message_text       = document.createElement("p");
  var time_date          = document.createElement("span");

  // ASSIGNING CLASSES
  incoming_msg.className       = "incoming_msg";
  incoming_msg_img.className   = "incoming_msg_img";
  received_msg.className       = "received_msg";
  received_withd_msg.className = "receiver_withd_msg"
  time_date.className          = "time_date";


  // ASSIGNING IMAGE URL AND ALT TEXT
  img.src = "https://ptetutorials.com/images/user-profile.png";
  img.alt = "sunil";
  
  // ASSIGNING INNER TEXT
  time_date.innerText = message.time + " | " + message.date;
  message_text.innerText = message.text;

  // NESTING ELEMENTS
  incoming_msg_img.appendChild(img);
  received_withd_msg.appendChild(message_text);
  received_withd_msg.appendChild(time_date);
  received_msg.appendChild(received_withd_msg);
  incoming_msg.appendChild(incoming_msg_img);
  incoming_msg.appendChild(received_msg);

  return incoming_msg;
}

function createOutgoingMessage(message) {
  var outgoing_msg  = document.createElement("div");
  var sent_msg      = document.createElement("div");
  var message_text  = document.createElement("p");
  var time_date     = document.createElement("span");

  // ASSIGNING CLASSES
  outgoing_msg.className = "outgoing_msg";
  sent_msg.className     = "sent_msg"
  time_date.className    = "time_date";
  
  // ASSIGNING INNER TEXT
  time_date.innerText = message.time + " | " + message.date;
  message_text.innerText = message.text;

  // NESTING ELEMENTS
  sent_msg.appendChild(message_text);
  sent_msg.appendChild(time_date);
  outgoing_msg.appendChild(sent_msg);

  return outgoing_msg;
}

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

  var conversation = document.getElementById("msg_send_btn").value;
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
