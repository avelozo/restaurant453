var errorMessage = "";

function requiredField(reqField, reqFieldName){

 if (reqField == null || reqField == "") {
        errorMessage= reqFieldName +" is a required field </br>";
        return false;
    }

}

function validateForm() {
	var validForm = true;
    /*Role*/ 
    if(document.forms["formRole"] != undefined){
        validForm= requiredField(document.forms["formRole"]["name"].value,"Name");
    }
    /*Restaurant*/
   if(document.forms["formRestaurant"] != undefined){
    validForm=requiredField(document.forms["formRestaurant"]["name"].value,"Name");
    }


    errorVisibility();
    return validForm;
}

function errorVisibility(){
    var alertWarning= document.getElementById("alertWarning");
if(errorMessage==""|| errorMessage==undefined){

	alertWarning.style.display= "none";
}else{

	alertWarning.style.display= "block";
	alertWarning.innerHTML= errorMessage;
}
}