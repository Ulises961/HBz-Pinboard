function createHTMLMessage(text){
    var message = document.createElement("div");
    var spaceColumn = document.createElement("div");
    var messageContent = document.createElement("div");

    message.className = "row";
    spaceColumn.className = "col-9";
    messageContent.className = "col-md-auto";
    messageContent.style = "background-color: goldenrod;";
    messageContent.innerText = text;
    
    message.appendChild(messageContent);
    message.appendChild(spaceColumn);

    return message;
}

function sendMessage(){
    var message_text = document.getElementById("inputMessage").value;
    var message = createHTMLMessage(message_text);

    document.getElementById("messages_section").appendChild(message);
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

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        console.log(this.responseText);
        if(isJson(this.responseText)){
            var conversations = JSON.parse(this.responseText);
            
            conversations.forEach(object => {
                var listItem = document.createElement("li");
                var conversation = JSON.parse(object);
                console.log(object);

                listItem.id = conversation.id;
                listItem.innerText = conversation.name;
                listItem.onclick = function(){changeConversation(conversation.id, conversation.name);};

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

  function showMessages(conversation){
    document.getElementById("messages_section").innerHTML = '';
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        console.log(this.responseText);
        if(isJson(this.responseText)){
          var messages = JSON.parse(this.responseText);
        
          messages.forEach(message => {
            var message_element = createHTMLMessage(message);

            document.getElementById("messages_section").appendChild(message_element);
          });
        }
        
      }
    };
    
    xmlhttp.open("GET", "./loadOldMessages.php?conversation="+conversation, true);
    xmlhttp.send();

    updateConversation(conversation);
  }

  function changeConversation(id, title){
    document.getElementById("conversationTitle").innerText = title;
    showMessages(id);
  }

  function updateConversation(conversation){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        console.log(this.responseText);

        if(isJson(this.responseText)){
          var messages = JSON.parse(this.responseText);
        
          messages.forEach(message => {
            var message_element = createHTMLMessage(message);
            document.getElementById("messages_section").appendChild(message_element);
          });
        }
        
      }
    };

    var parameters = "conversation=" + conversation;
    
    xmlhttp.open("GET", "./updateConversation.php?" + parameters, true);
    xmlhttp.send();

    setTimeout(function(){updateConversation(conversation);}, 5500);
  }
