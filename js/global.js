
function displayOptions(obj){

    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var student_program = document.getElementById("study_program");
    var subjects_taught = document.getElementById("professor_form");
    
    
    if( selected === "student"){
     
        student_program.style.display="block";
        subjects_taught.style.display="none";
    
    }else if (selected === "professor"){
        
       subjects_taught.style.display="block";
       student_program.style.display="none";
       
      
   }
    else{
        student_program.style.display="none";
        subjects_taught.style.display="none";

        
    }
}


function load(){
    console.log(" results displayed?");
    $.ajax({
        method: "POST",
        url: "./dbfunctions.php",
        data: {text:"SELECT name FROM Program;"}

    })
    .done(function(response){
            $("datalist.programs").html(response);
        
        console.log(" results displayed?"+ response);
    });
}
