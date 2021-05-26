var validCode;

function submitToServer() {
    if(validCode.validity){
    $.ajax(
        {
           url: "php/session_php/checkCode.php?code="+validCode.code,
           success: function(response){
               console.log(response);
               if(response === "true"){
                $("#pswd-block").css("display","block");
                $("#check-block").css("display","block");
                $("#submitBtn").css("display","block");
               }else{
                   validCode.validity=false;
                   submitToServer();
               }
            }
        }
               
       );
    }else{
        alertInvalidInput("Invalid Code");
    }
}

$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
        if (code === 13) {
        code="";
        e.preventDefault();
        return false;
       
    }
});

function codeCheck(input){

    var regex = /^\d{6}$/;
    var message = "Code number must be 6 digits long";
 
    var code=input.value;
    var codeFeedback=document.getElementById("code-feedback");
    if(code !== ""){
        validCode ={'validity':validityCheck(regex,message,code,codeFeedback), 'code':code};
        console.log(validCode);
    }else{
        codeFeedback.style.display="none";
        return false;
    }

}

function checkAndSubmitForm(){
       
        var validPassword = validPswd($("#password")[0]); 
        var matchingPassword = matchesPassword($("#pswd-check")[0]);
        console.log("V.P "+validPassword+" M.P."+matchingPassword+ " Code valid: "+ validCode.validity);
        if(validPassword && matchingPassword && validCode.validity){
            $("#form").submit();
        }else{
            alertInvalidInput("Invalid Password");
        }
}
function alertInvalidInput(message){
    alert(message);
    $("#password")[0].value= "";
    $("#pswd-check").value= "";
    $("#code")[0].value= "";

    window.location.href = "ResetPassword.php";
}