function validateForm(){
    var fname = document.forms["user_details"]["first_name"].value;
    var lname = document.forms["user_details"]["last_name"].value;
    var city = document.forms["user_details"]["city_name"].value;
    //note user_details is the name of my form
    if(fname ==null || lname == "" ||city == ""){
        alert ("All required details were not suplied");
        return false;
    }
    return true;
    //if the user has disabled script in his browser, this won't display, so we add server side validation
}