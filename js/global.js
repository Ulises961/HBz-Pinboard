
function registerUser(){

   

}

function displayOptions(obj){

    var selectBox = obj;
    var selected = selectBox.options[selectBox.selectedIndex].value;
    var studentStatus = document.getElementById('studentStatus');
    
    if( selected === "student"){

        studentStatus.style.display = "block";
    
    }else{
       studentStatus.style.display = "none";
   }
    

}