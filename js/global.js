
function displayOptions(obj){

    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    
    var student_program = document.getElementById("study_program");
    var student_input = document.getElementById("study_programs");
   
    var subjects_taught = document.getElementById("professor_form");
    var subject_input =document.getElementById("subject-input");
    
    var office_hours =document.getElementById("office_hours_block");
    var office =document.getElementById("office_block");
    
    
    if( selected === "student"){
     
        student_program.style.display="block";
        student_input.removeAttribute("disabled");

        subjects_taught.style.display="none";
        subject_input.disabled="enabled";

        office.style.display="none";
        office_hours.style.display="none";

       
        loadPrograms();
    }else if (selected === "professor"){
        
       subjects_taught.style.display="block";
       student_program.style.display="none";
       student_input.disabled="enabled";
       subject_input.removeAttribute("disabled");
       loadSubjects();
      
       office.style.display="flex";
       office_hours.style.display="flex";

   }
    else{
        student_program.style.display="none";
        subjects_taught.style.display="none";
        
        student_input.disabled="enabled";
        subject_input.disabled="enabled";


        office.style.display="none";
        office_hours.style.display="none";

    }
}


function addSubjectBlock(obj){
  
    var block = document.getElementById("professor_form"); 
    var originalAppendableBlock = obj.parentNode.parentNode;
    var clnAppendableBlock = originalAppendableBlock.cloneNode(true);
    var input = findId("subject-input",clnAppendableBlock); 
    input[0].name="subject-input["+i+"]";
    input[0].value="";
   
    block.appendChild(clnAppendableBlock);
    
    var inClass=findId("deleteBtn",clnAppendableBlock);
   
    var deleteBtn=inClass[0];
    deleteBtn.style.display="block";
    i++;
   
}

function deleteSubjectBlock(obj){
    console.log("starting function");
    var block = document.getElementById("professor_form");
    var originalAppendableBlock = obj.parentNode.parentNode;
    block.removeChild(originalAppendableBlock);
    
}


function matchesPassword(){

        var firstPsswd= document.getElementById("password");
        var psswdCheck= document.getElementById("password-check");
        var matching_feedback= document.getElementById("matching-feedback");
    
       
        
        matching_feedback.style.display="flex";

        if(firstPsswd.value === psswdCheck.value){
        
            matching_feedback.setAttribute("class","valid-feedback");
            matching_feedback.innerText='Matching ✔';
    
        }else{

            matching_feedback.setAttribute("class","invalid-feedback");
            matching_feedback.innerText='Not Matching ✘';
        
        }
          
}




function validPswd(obj){

    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    var message = "Password must be at least 6 charachters long, contain an uppercase letter (A-Z), a lowercase letter (a-z) and a digit (1-9).";
    
    
    var pswd=obj.value;
    matchesPassword();
    var pswdFeedback=document.getElementById("pswd-feedback");
    if (obj.value !== ""){
        validityCheck(regex,message,pswd,pswdFeedback);
    }else{
        pswdFeedback.style.display="none";
    }
  
    
}


function validityCheck(regex, message, valueToTest,messageDiv){

    if(valueToTest.match(regex)){
        messageDiv.setAttribute("class","valid-feedback");
        messageDiv.innerText="Valid ✔";
        messageDiv.style.display="flex";
    }else{
        messageDiv.setAttribute("class","invalid-feedback");
        messageDiv.innerText=message;
        messageDiv.style.display="flex";

    }


}

function phoneCheck(obj){

    var regex = /^\d{4}\s?\d{6}$/;
    var message = "Phone number must be 10 digits long";
 
    var number=obj.value;
    var phoneFeedback=document.getElementById("phone-feedback");
    if (obj.value !== ""){
        validityCheck(regex,message,number,phoneFeedback);
    }else{
        phoneFeedback.style.display="none";
    }


}

function prefixCheck(obj){

    var regex = /^(\+)?(?:[0-9]?){1,4}$/;

    var message = "'+'/'00'(prefix)";
 
    var number=obj.value;
    var prefixFeedback=document.getElementById("prefix-feedback");
    if (obj.value !== ""){

        validityCheck(regex,message,number,prefixFeedback);
    }
    else{
        prefixFeedback.style.display="none";
    }

}



function loadPrograms() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.response); 
            
          for(var i = 0 ; i < result.length; i++){
                var option= document.createElement("option");
                option.onchange= function(){ hideItemFromList();  };
                option.value= result[i];
                document.getElementById("programs").appendChild(option);
                  
            }
                
        }
    };
    

    xmlhttp.open("GET", "phpFunctions/loadPrograms.php", true);
    xmlhttp.send();
}

function loadSubjects() {
    var xmlhttp = new XMLHttpRequest();
  
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var displayedSubjects = JSON.parse(this.response); 
            for(var i = 0 ; i < displayedSubjects.length; i++){
                var lines = displayedSubjects[i];
                var option= document.createElement("option");
                option.value=lines[1];
                option.id= lines[0];
             
                document.getElementById("subjects").appendChild(option);
             
            }   
          
        }
    };
    

    xmlhttp.open("GET", "phpFunctions/loadSubjects.php", true);
    xmlhttp.send();
}

function findId(id,obj){
    var inClass = [];
    
    
    function findClass(element){
        
            if(element.id === id){
            inClass.push(element);
        }
    }
    
    function testNodes(node,test){
        test(node);
        node = node.firstChild;
        while(node){
            testNodes(node,test);
            node=node.nextSibling;
        }
    }
    
    testNodes(obj,findClass);
    return inClass;
}

function hideItemFromList(obj){

    var list = findId("subjects",obj.parentNode);
    var str= obj.value;
    
    values = list[0].childNodes;
    
    values.forEach(element => {
        console.log(str+ element.value);
        if (element.value === str){
            element.style.display="none";
             }     
    });
}
function showPswd() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  } 


  function uniqueMail(obj){
    var xmlhttp = new XMLHttpRequest();
    var repeated_email_alert = document.getElementById("mail-feedback");
    
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {


        if(obj.value === ""){
            repeated_email_alert.style.display="none";
        }else{

            if (Number(this.response) != "0"){
              
                repeated_email_alert.className = "invalid-feedback";
                repeated_email_alert.innerText ='The email inserted belongs to a registered user';
                
            }else{
                repeated_email_alert.className = "valid-feedback";
                repeated_email_alert.innerText ="Valid ✔";
                

            }
                repeated_email_alert.style.display="block";
            }   
        };
        
    };
    

    xmlhttp.open("GET", "phpFunctions/getMail.php?mail="+obj.value, true);
    xmlhttp.send();
  }

  function checkInputPresence(obj, messageDiv, action){

    if (obj.value == ""){

        messageDiv.style.display="none";

    }else{
        messageDiv.style.display="flex";
        action.method();
    }
  }