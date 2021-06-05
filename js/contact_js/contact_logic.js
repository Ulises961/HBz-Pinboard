

function searchUsers(){
    var searchTerm = document.getElementById("search").value;
    var parameters = "searchTerm=" + searchTerm;

    $.ajax({
        url: "./php/contact_php/loadSearchUser.php?" + parameters, 
        success: function(response){
            insertRows(response);
        
        }
    });
}

function nextPage(){
    changePage(+1);
}
function previousPage(){
    changePage(-1);
 }


function changePage(nextpos){
     
    var activepage = $(".page-item.active");
    var index = parseInt(activepage[0].innerText) + nextpos;
    console.log(index);
 
    getRows("./php/contact_php/indexer.php?+page="+index);
 }


function nextSet(){
    changeSet("next");
}

function previousSet(){
    changeSet("prev");
 }


 function changeSet(nextpos){
    
    getRows("./php/contact_php/indexer.php?+next_set="+nextpos);
 }

function selectPage(index){
    getRows("./php/contact_php/indexer.php?+page="+index);
}


function getRows(query){
    $.ajax({
        url: query, 
        success: function(response){insertRows(response);}
      });
 }

 function insertRows(response){
    $("#search-result").empty();
    $("#search-result").append(response);
 
    
}