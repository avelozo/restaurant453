function showDetails(orderId)
{
	var url = 'index.php';
	var data = { op : 'showDetails', orderId : orderId };

	callServer(url, data, fillOrderDetails, alert);
}

function fillOrderDetails(response)
{
	jQuery(".orderDetailsContent").append(response.responseText);
}

function callServer(url, data, complete, error)
{
	jQuery.ajax({
	  type: "POST",
	  url: url,
	  data: data,
	  complete: function (response) 
	  			{
				  	if(complete !== undefined)
				  		complete(response)
				},
	  error: function(resp)
	  		{
			  	if(error !== undefined)
	   				error(resp);
			}
  	});
}