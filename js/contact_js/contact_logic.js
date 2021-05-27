

function searchUsers(){
    var searchTerm = document.getElementById("search").value;
    var parameters = "searchTerm=" + searchTerm;

    $.ajax({
        url: "./php/contact_php/loadSearchUser.php?" + parameters, 
        success: function(response){
            $("#contactTable").empty();
            $("#contactTable").append(response);
        }
    });
}