function vote(value, id){
  
    let xmlhttp= new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          showAnswerVotes(id);
        }
    };
    
    let data = {value:value, id:id};

    xmlhttp.open("POST", "php/forum_php/insertVote.php", true);
    xmlhttp.send(JSON.stringify(data));

}

function showAnswerVotes(id){
  
    let votes = document.getElementById("count-"+id);


    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
       
        if (this.readyState == 4 && this.status == 200) {
            votes.innerHTML=this.response;
        }
    };

      xmlhttp.open("GET", "php/forum_php/loadVotes.php?post="+id, true);
      xmlhttp.send();

}

function getQuestion(id){
  
    let title = document.getElementById("title");
    let content = document.getElementById("text");

    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        
        if (this.readyState == 4 && this.status == 200) {
            let responseObj= JSON.parse(this.responseText);
            console.log((this.responseText));
            title.innerHTML=responseObj[0].title;
            content.innerHTML=responseObj[0].text;
            showAnswerVotes(id);
        }
    };

      xmlhttp.open("GET", "php/forum_php/loadSelectedQuestion.php?post="+id, true);
      xmlhttp.send();

}
function insertAnswer(questionId,user){
  
    var xmlhttp = new XMLHttpRequest();
    var text = document.getElementById("editor");
    console.debug();
    var json = {"questionId":questionId, "user":user, "text":text.value, "title":"answer"};
    console.log(questionId,user,text,title,json);
    var data = JSON.stringify(json);
    console.log(data);
    console.log("calling insertAnswer");
    xmlhttp.onreadystatechange = function () {

        if ( this.readyState == 4 && this.status == 200){
            console.log("sucessful connection");
            console.log(this.responseText);
            showAnswers(this.responseText);
            text.value="";
        }
    }
    xmlhttp.open("POST", "php/forum_php/insertPost.php");
    xmlhttp.send(data);
}

function showAnswers(post){

    var answers = document.getElementById("answer");
    var newAnswer = document.createElement("div");
    var content = document.createTextNode(post);
    newAnswer.setAttribute("class", "card-body pl-3 answer");
    newAnswer.setAttribute("id", "text");
    newAnswer.appendChild(content);
    answers.appendChild(newAnswer);
    
}