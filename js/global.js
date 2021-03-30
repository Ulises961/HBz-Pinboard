
function displayOptions(obj){

    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var student_program = document.getElementById("study_program");
    var subjects_taught = document.getElementById("professor_form");
    
    
    if( selected === "student"){
     
        student_program.style.display="block";
        subjects_taught.style.display="none";
        loadPrograms();
    }else if (selected === "professor"){
        
       subjects_taught.style.display="block";
       student_program.style.display="none";
       loadSubjects();
      
   }
    else{
        student_program.style.display="none";
        subjects_taught.style.display="none";

        
    }
}

function addSubjectBlock(){
    console.log("starting function");
    var block = document.getElementById("professor_form");
    var originalAppendableBlock = document.getElementById("subjects-block");
    var clnAppendableBlock = originalAppendableBlock.cloneNode(true);
    
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
        var validPw= document.getElementById("cPwdValid");
        var invalidPw= document.getElementById("cPwdInvalid");
      
      
        if(firstPsswd.value === psswdCheck.value){
            validPw.style.display="block";
            invalidPw.style.display="none";
            validPw.innerText='Matching ✔';
      
            console.log("valid PW");
            

        }else{
            invalidPw.style.display="block";
            validPw.style.display="none";
            invalidPw.innerText='Not Matching ✘';

            console.log("invalid PW");
           
        }

}

function loadPrograms() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.response); 
            
          for(var i = 0 ; i < result.length; i++){
                var option= document.createElement("option");
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
            var result = JSON.parse(this.response); 
            
          for(var i = 0 ; i < result.length; i++){
                var option= document.createElement("option");
                option.value= result[i];
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