var chatUpdateInterval;

function createHTMLMessage(message) {
  var messageElement = document.createElement("div");
  var spaceColumn = document.createElement("div");
  var messageContent = document.createElement("div");

  messageElement.className = "row";
  messageElement.id = message.id;
  spaceColumn.className = "col-9";
  messageContent.className = "col-md-auto";
  messageContent.style = "background-color: goldenrod;";
  messageContent.innerText = message.text;

  messageElement.appendChild(messageContent);
  messageElement.appendChild(spaceColumn);

  return messageElement;
}

function sendMessage() {
  var message_text = document.getElementById("inputMessage").value;
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (this.responseText != "success")
        alert("An error occurred while sending the message.");
    }
  };

  var user = 1;
  var conversation = document.getElementById("sendMessageBtn").value;
  var parameters = "conversation=" + conversation + "&message=" + message_text + "&user=" + user;
  console.log("I am sending these parameters: " + parameters);

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

function loadConversations() {
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

  var user = 1;

  xmlhttp.open("GET", "./loadConversation.php?user=" + user, true);
  xmlhttp.send();
}

loadConversations();

function showMessages(conversation) {
  clearInterval(chatUpdateInterval);
  document.getElementById("messages_section").innerHTML = '';
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      console.log(this.responseText);
      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(json_message => {
          var message = JSON.parse(json_message);
          var message_element = createHTMLMessage(message);

          document.getElementById("messages_section").appendChild(message_element);
        });
      }

    }
  };

  xmlhttp.open("GET", "./loadOldMessages.php?conversation=" + conversation, true);
  xmlhttp.send();

  chatUpdateInterval = setInterval(function () { updateConversation(conversation); }, 2500);
}

function changeConversation(id, title) {
  document.getElementById("conversationTitle").innerText = title;
  document.getElementById("sendMessageBtn").value = id;
  showMessages(id);
}

function updateConversation(conversation) {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      console.log(this.responseText);

      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(json_message => {
          var message = JSON.parse(json_message);
          var message_element = createHTMLMessage(message);

          document.getElementById("messages_section").appendChild(message_element);
        });
      }

    }
  };

  var parameters = "conversation=" + conversation;

  xmlhttp.open("GET", "./updateConversation.php?" + parameters, true);
  xmlhttp.send();
}
