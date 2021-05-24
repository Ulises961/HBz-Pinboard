function check(obj) {
    $.ajax(
        {
           url: "php/session_php/checkCode.php?code="+obj.value,
           
           success: function(response){
                $("#new-pswd").append(response);
                   
            }
        } 
    );

}