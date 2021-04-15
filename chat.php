
<html>

<head>
  <link href="css/chat.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"rel="stylesheet">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!-- this script contains the whole chat logic -->
  <script src="js/chat_js/chat_logic.js"></script>
  
</head>

<body>
  <div class="container">
    <h3 class=" text-center" id="conversationTitle">Messaging</h3>
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar" placeholder="Search">
                <span class="input-group-addon">
                  <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span>
              </div>
            </div>
          </div>
  
          <!-- ALL THE ONGOING CONVERSATIONS WILL BE LOADED INSIDE THIS DIV -->
          <div class="inbox_chat">
            <?php include "php/chat_php/loadConversations.php";?>
          </div>

        </div>
        <div class="mesgs">

          <div class="msg_history" id="msg_history">
            <!-- THE MESSAGES OF THE CHAT WILL BE LOADED HERE USING AJAX -->
          </div>

          <!-- INPUT-FIELD AND BUTTON TO SEND A MESSAGE -->
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" name="inputMessage" id="inputMessage" placeholder="Type a message" />
              <button class="msg_send_btn" type="button" id="msg_send_btn" onclick="sendMessage()">
                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
              </button>
            </div>
          </div>

        </div>
      </div>


    </div>
  </div>
</body>

</html>

