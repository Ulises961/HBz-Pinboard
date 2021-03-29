
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
    var block = document.getElementById("subjects-block");
    var originalAppendableBlock = document.getElementById("subject-appendable-block");
    var clnAppendableBlock = originalAppendableBlock.cloneNode(true);
    block.appendChild(clnAppendableBlock);
    console.log("error"+clnAppendableBlock.textContent);
    
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

