
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


function load() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var option = document.createElement("option");
            option.value = this.responseText;
            document.getElementById("programs").appendChild(option);
        }
    };

    xmlhttp.open("GET", "./dbfunctions.php", true);
    xmlhttp.send();
}

// function load(){
//     console.log(" results displayed?");
//     $.ajax({
//         method: "GET",
//         url: "./dbfunctions.php",
//         data: {text:"SELECT name FROM Program;"}

//     })
//     .done(function(response){
//             $("datalist.programs").html(response);
        
//         console.log(" results displayed?"+ response);
//     });
// }
