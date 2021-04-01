var chatUpdateInterval;
var user = 1;

function createHTMLMessage(message) {
  var messageElement = document.createElement("div");
  var spaceColumn = document.createElement("div");
  var messageContent = document.createElement("div");

  messageElement.className = "row";
  messageElement.id = message.id;
  spaceColumn.className = "col-9";
  messageContent.className = "col-md-auto";
 
  if(message.users == user)
    messageContent.style = "background-color: goldenrod;";
  else
    messageContent.style = "background-color: fuchsia;";


  messageContent.innerText = message.time + ": " + message.text;

  messageElement.appendChild(messageContent);
  messageElement.appendChild(spaceColumn);

  return messageElement;
}

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

showConversations();

function loadConversation(conversation) {
  clearTimeout(chatUpdateInterval);
  document.getElementById("messages_section").innerHTML = '';
  var xmlhttp = new XMLHttpRequest();
  var lastMessageTime;

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      
      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(json_message => {
          var message = JSON.parse(json_message);
          var message_element = createHTMLMessage(message);
          lastMessageTime = message.time;
          console.log(message.time);
          
          document.getElementById("messages_section").appendChild(message_element);
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
  document.getElementById("sendMessageBtn").value = id;
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
          var message_element = createHTMLMessage(message);
          lastMessageTime = message.time;
          console.log(message.time);

          document.getElementById("messages_section").appendChild(message_element);
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
