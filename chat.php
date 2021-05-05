
<html>

<head>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="css/home_main.css" rel="stylesheet">
    <link href="forum.css" rel="stylesheet">

    <!-- home main test -->
    <link href="css/home_main.css" rel="stylesheet">
<!-- / test -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>

  <link href="css/chat.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"rel="stylesheet">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!-- this script contains the whole chat logic -->
  <script src="js/chat_js/chat_logic.js"></script>
  
</head>
<?php include "navbar.php"?>
<body>
  <div class="container-fluid">
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

<?php include "footer.php"?>

</body>

</html>

