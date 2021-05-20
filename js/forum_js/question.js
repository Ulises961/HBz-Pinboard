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
            console.log("votes: " +this.response);
        }
    };

    xmlhttp.open("GET", "php/forum_php/getPostVotes.php?post="+id, true);
    xmlhttp.send();

}


function insertAnswer(questionId){
  
        var xmlhttp = new XMLHttpRequest();
        var text = document.getElementById("editor");
    
        var json = {"questionId":questionId, "text":text.value, "title":"answer"};
    
        text.value="";

        var data = JSON.stringify(json);
    
        xmlhttp.onreadystatechange = function () {

            if ( this.readyState == 4 && this.status == 200){

                showAnswers(this.responseText);
                
            }
        }
        xmlhttp.open("POST", "php/forum_php/insertPost.php");
        xmlhttp.send(data);
    
}

function showAnswers(post){

    var answers = document.getElementById("answer");
    var newAnswer = document.createElement("div");
    newAnswer.innerHTML=post;
   console.log(post);
    answers.appendChild(newAnswer);
    
       
}
function insertComment(id){
 
    var xmlhttp = new XMLHttpRequest();
    var input = document.getElementById("insertComment-"+id);
    if (input.value !==""){
    
  
    xmlhttp.onreadystatechange = function () {

        if ( this.readyState == 4 && this.status == 200){
           
           showComment(this.responseText,id);
           input.value="";
        }
    }
  
    var data = {"comment":input.value,"question":id};
    var json = JSON.stringify(data);
    xmlhttp.open("POST", "php/forum_php/insertComment.php");
    xmlhttp.send(json);
    }

}
function showComment(comment,id){
    var comments= document.getElementById("comments-"+id);
    var newComment = document.createElement("div");
    newComment.innerHTML=comment;
    comments.appendChild(newComment);
    
}

function searchForum(obj){
  
        let question= obj.value;
        var query = "question="+question;
       getQuestions(query);
    
}

function nextPage(){
    changePage(+1);
}

function previousPage(){
    changePage(-1);
 }

function selectPage(index){
    getQuestions("page="+index);
}

 function changePage(nextpos){
     
    var activepage = $(".page-item.active");
    var index = parseInt(activepage[0].innerText) + nextpos;
    console.log(index);
 
    getQuestions("page="+index);
 }

 function getQuestions(query){
    $.ajax({
        url: "./php/forum_php/loadQuestions.php?"+query, 
        success: function(response){
            $("#questions").empty();
            $("#questions").append(response);
            console.log(response);
        }
      });
 }