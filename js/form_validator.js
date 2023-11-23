function FormValidation() {
    var user = document.getElementById("user").value;
	var pass = document.getElementById("pass").value;
    if(user.length == 0) {
        alert("Please Enter username");
        return false;   
    }
    else if(pass.length == 0) {
        alert("Please Enter password");
        return false;   
    }
    return true;
    



}

$(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
    
});








function checkField()
{  
    var filled=document.getElementsByName("problem")[0].value;
if(!filled)
{
alert(" Please write your Problem Description ");
return false;
}

return true;
}


