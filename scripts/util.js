function confirmDelete(msg, url, id)
{
	if(confirm(msg))
	{
		callDeleteRoutine(url, id);
	}
	else
	{
		return false;
	}
}

function callDeleteRoutine(url, id)
{
	jQuery.ajax({
	  type: "POST",
	  url: url,
	  data: { action: "idelete", id: id },
	  complete: function (response) {
	  	location.reload(true);
	  },
	  error: function(resp){
   		alert(resp);
	}
  	});
}