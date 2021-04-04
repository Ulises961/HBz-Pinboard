var chatUpdateInterval = 2500; // this is the update frequency
var chat_timeout; // this is the variable on which the timeout function is called
var user = 1; // this is the id of the currently logged user, it must be changed in the future


// THIS FUNCTION IS CALLED WHEN THE USER CHANGES CONVERSATION
// AND IT STARTS LOADING THE MESSAGES BELONGING TO THAT CONVERSATION
function changeConversation(id, title) {
  document.getElementById("conversationTitle").innerText = title;
  document.getElementById("msg_send_btn").value = id;
  document.getElementById("msg_history").innerHTML = '';
  clearTimeout(chat_timeout); // stops updating the previous conversation
  loadConversation(id);
}

// THIS FUNCTION IS CALLED WHEN THE USER PRESSES THE SEND MESSAGE BUTTON
// AND THE FUNCTION MAKES AN AJAX CALL TO A PHP SCRIPT THAT INSERTS THE MESSAGE INTO THE DB
function sendMessage() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };

  var conversation = document.getElementById("msg_send_btn").value;
  var message_text = document.getElementById("inputMessage").value;
  var parameters = "conversation=" + conversation + "&message=" + message_text + "&user=" + user;

  document.getElementById("inputMessage").value = " "; // empties the message input field

  xmlhttp.open("GET", "./chat_php/sendMessage.php?" + parameters, true);
  xmlhttp.send();
}


// THIS FUNCTION LOADS THE OLD MESSAGES BELONGING TO A CONVERSATION
function loadConversation(conversation) {
  var xmlhttp = new XMLHttpRequest();
  var lastMessageTime;

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(message => {
          var message_element = createMessageElement(message);

          lastMessageTime = message.time;
          
          document.getElementById("msg_history")
                  .appendChild(message_element);

          message_element.scrollIntoView();
        });

      }else{
        console.log(this.responseText);
      }

      updateConversation(conversation, lastMessageTime);
    }
  };

  xmlhttp.open("GET", "./chat_php/loadConversation.php?conversation=" + conversation, true);
  xmlhttp.send();
}


// THIS FUNCTION KEEPS THE CHAT UPDATED AND EVERY 2.5 SECONDS CHECKS FOR NEW MESSAGES
function updateConversation(conversation, lastMessageTime) {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (isJson(this.responseText)) {
        var messages = JSON.parse(this.responseText);

        messages.forEach(message => {
          var message_element = createMessageElement(message);

          lastMessageTime = message.time;
          
          document.getElementById("msg_history")
                  .appendChild(message_element);

          message_element.scrollIntoView();
        });

      }else{
        console.log(this.responseText);
      }

    }
  };

  var parameters = "conversation=" + conversation + "&time=" + lastMessageTime;

  xmlhttp.open("GET", "./chat_php/updateConversation.php?" + parameters, true);
  xmlhttp.send();

  chat_timeout = setTimeout(function () {updateConversation(conversation, lastMessageTime); }, chatUpdateInterval);
}

// CREATES THE HTML MESSAGE ELEMENT
function createMessageElement(json_message){
  var message = JSON.parse(json_message);

  if(message.users == user)
    return createOutgoingMessage(message);
  else
    return createIncomingMessage(message);
}

// CHECKS IF A STRING IS JSON
function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}