function showProducts(orderId)
{
	var url = 'index.php';
	var data = { op : 'showProducts', orderId : orderId };

	callServer(url, data, fillProductDetails, alert);
}

function addProducts(orderId)
{
	var url = 'index.php';
	var data = { op : 'addProducts', orderId : orderId, productQuantity : productQuantity };

	callServer(url, data, fillOrderDetails, alert);
}

function fillProductDetails(response)
{
	jQuery(".ordersProducts").html(response.responseText);
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