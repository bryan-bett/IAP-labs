function validateForm(){
    var fname = document.forms["user_details"]["first_name"].value;
    var lname = document.forms["user_details"]["last_name"].value;
    var city = document.forms["user_details"]["city_name"].value;
    var pass = document.forms["user_details"]["password"].value;
    var uname = document.forms["user_details"]["username"].value;
    var file = document.forms["user_details"]["fileToUpload"].value;

    if(fname ==null || lname == "" ||city == "" || pass == "" || uname == ""){
        alert ("All required details were not suplied");
        return false;
    }
    else if(file == null){
        alert ("Please add profile picture");
        return false;
    }
    return true;
    //if the user has disabled script in his browser, this won't display, so we add server side validation
}