

function displayOptions(obj){

    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    
    var student_program = document.getElementById("study_program");
    var student_input = document.getElementById("study_programs");
   
    var subjects_taught = document.getElementById("professor_form");
    var subject_input =document.getElementById("subject-input");
    
    
    if( selected === "student"){
     
        student_program.style.display="block";
        student_input.removeAttribute("disabled");

        subjects_taught.style.display="none";
        subject_input.setAttribute("disabled","enabled");
       
        loadPrograms();
    }else if (selected === "professor"){
        
       subjects_taught.style.display="block";
       student_program.style.display="none";
       student_input.setAttribute("disabled","enabled");
       subject_input.removeAttribute("disabled");
       loadSubjects();
      
   }
    else{
        student_program.style.display="none";
        subjects_taught.style.display="none";
        
        student_input.setAttribute("disabled","enabled");
        subject_input.setAttribute("disabled","enabled");
    }
}

function addSubjectBlock(obj){
    console.log("starting function");
    var block = document.getElementById("professor_form");
    var originalAppendableBlock = obj.parentNode.parentNode;
    var clnAppendableBlock = originalAppendableBlock.cloneNode(true);
    var input = getElementsByClassName("subject-input",clnAppendableBlock);
    input[0].value="";
   
    block.appendChild(clnAppendableBlock);
    
    var inClass=getElementsByClassName("deleteBtn",clnAppendableBlock);
   
    var deleteBtn=inClass[0];
    deleteBtn.style.display="block";

   
}

function deleteSubjectBlock(obj){
    console.log("starting function");
    var block = document.getElementById("professor_form");
    var originalAppendableBlock = obj.parentNode.parentNode;
    block.removeChild(originalAppendableBlock);
    
}

function validPswd(obj){
    var pswd=obj.value;
    matchesPassword();
    var pswdValid=document.getElementById("pswd-feedback");
    if(pswd.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/)){
        pswdValid.setAttribute("class","valid-feedback");
        pswdValid.innerText="Valid ✔";
        pswdValid.style.display="block";
    }else{
        pswdValid.setAttribute("class","invalid-feedback");
        pswdValid.innerText="Password must be at least 6 charachters long, contain an uppercase letter (A-Z), a lowercase letter (a-z) and a digit (1-9).";
        pswdValid.style.display="block";

    }
}

function matchesPassword(){

        var firstPsswd= document.getElementById("password");
        var psswdCheck= document.getElementById("password-check");
        var matching_feedback= document.getElementById("matching-feedback");
    
        if(firstPsswd.value === ""){
            matching_feedback.style.display="none";
            console.log("invalid PW");
                
        }else{
            matching_feedback.style.display="block";

            if(firstPsswd.value === psswdCheck.value){
            
                matching_feedback.setAttribute("class","valid-feedback")
                matching_feedback.innerText='Matching ✔';
        
      

            }else{

                matching_feedback.setAttribute("class","invalid-feedback")
                matching_feedback.innerText='Not Matching ✘';

             
            
            }
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
                var option= document.createElement("option");
                option.value= displayedSubjects[i];
                document.getElementById("subjects").appendChild(option);
             
            }   
          
        }
    };
    

    xmlhttp.open("GET", "phpFunctions/loadSubjects.php", true);
    xmlhttp.send();
}


    function getElementsByClassName(id,obj){
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

function hideItemFromList(){

    // var list = getElementsByClassName("subjects",obj.parentNode);
    // var str= obj.value;
    
    // values = list[0].childNodes;
    
    // values.forEach(element => {
    //     console.log(str+ element.value);
        if (element.value === str){
            element.setAttribute("style","display:none");
             }     
    // });
}
function showPswd() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  } 