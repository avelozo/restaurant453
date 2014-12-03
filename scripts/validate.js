var errorMessage = "";

function requiredField(reqField, reqFieldName) {

    if(reqField == null || reqField == "") {
        errorMessage = errorMessage + reqFieldName + " is a required field </br>";
        return false;
    }

}

function validateForm() {
    errorMessage = "";

    /*Role*/
    if(document.forms["formRole"] != undefined) {
        requiredField(document.forms["formRole"]["name"].value, "Name");
    }
    /*Restaurant*/
    if(document.forms["formRestaurant"] != undefined) {
        requiredField(document.forms["formRestaurant"]["name"].value, "Name");
    }
    /*Employee*/
    if(document.forms["formEmployee"] != undefined) {
        requiredField(document.forms["formEmployee"]["ssn"].value, "SSN");
        requiredField(document.forms["formEmployee"]["firstName"].value, "First Name");
        requiredField(document.forms["formEmployee"]["lastName"].value, "Last Name");
        requiredField(document.forms["formEmployee"]["userName"].value, "Username");
        requiredField(document.forms["formEmployee"]["password"].value, "Password");
        requiredField(document.forms["formEmployee"]["restaurant"].value, "Restaurant");
        requiredField(document.forms["formEmployee"]["role"].value, "Role");
    }
    errorVisibility();
    return errorMessage == "" ? true : false;
}

function errorVisibility() {
    var alertWarning = document.getElementById("alertWarning");
    if(errorMessage == "" || errorMessage == undefined) {

        alertWarning.style.display = "none";
    } else {

        alertWarning.style.display = "block";
        alertWarning.innerHTML = errorMessage;
    }
}