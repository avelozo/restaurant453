function callDeleteRoutine(url, id, getTableBody, callback)
{
	jQuery.ajax({
	  type: "POST",
	  url: url,
	  data: { action: "idelete", id: id },
	  complete: function (response) {
	  	if(getTableBody !== undefined)
	  		getTableBody(url, -1 , callback);
	  	else
	  		location.reload(true);
	  },
	  error: function(resp){
   		alert(resp);
	}
  	});
}

$( document ).ready(function(){

	  $(".button-collapse").sideNav();
})