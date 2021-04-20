function vote(value, id){
  
    let xmlhttp= new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          showAnswerVotes(id);
        }else{
            console.log("failure!");
        }
    };
    
    let data = {value:value, id:id};

    xmlhttp.open("POST", "php/forum_php/insertVote.php", true);
    xmlhttp.send(JSON.stringify(data));

}

function showAnswerVotes(id){
  
    let votes = document.getElementById("count");


    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        console.log("Show ansert votes response text: "+this.response);
        if (this.readyState == 4 && this.status == 200) {
            votes.innerHTML=this.response;
        }
    };

      xmlhttp.open("GET", "php/forum_php/loadVotes.php?post="+id, true);
      xmlhttp.send();

}

function getQuestion(id){
    console.log("Id is: "+ id);
    let title = document.getElementById("title");
    let content = document.getElementById("text");

    let xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        console.log("GetQuestion response text: "+this.response);
        if (this.readyState == 4 && this.status == 200) {
            let responseObj= JSON.parse(this.responseText);
            title.innerHTML=responseObj[0].title;
            
            content.innerHTML=responseObj[0].text;
        }else {console.log("No Question to load!!!");}
    };

      xmlhttp.open("GET", "php/forum_php/loadSelectedQuestion.php?post="+id, true);
      xmlhttp.send();

}
