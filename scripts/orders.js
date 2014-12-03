function showDetails(orderId)
{
	var url = 'index.php';
	var data = { op : 'showDetails', orderId : orderId };

	callServer(url, data, fillOrderDetails, alert);
}

function payOrder(orderId)
{
	if(confirm('Would you like to close this order?'))
	{
		var url = 'index.php';
		var data = { op : 'payOrder', orderId : orderId };

		callServer(url, data, payOrderCallback, alert);
	}
}

function addCustomer(orderId)	
{
	var customerId = jQuery('.customerNumber').val();

	if(customerId.trim().length == 0)
	{
		alert("Customer number required.");
		clearCustomerNumber();
	}
	else
	{
		var url = 'index.php';
		var data = { op : 'addCustomer', orderId : orderId, customerId : customerId };

		callServer(url, data, addCustomerCallback, alert);
	}
}

function chooseProduct(orderId)
{
	var url = 'index.php';
	var data = { op : 'chooseProduct', orderId : orderId };

	//callServer(url, data, fillOrderDetails, alert);
}

function addTable(employeeId)
{
	var tableNumber = jQuery('.tableNumber').val();
	
	var url = 'index.php';
	var data = { op : 'addTable', tableNumber : tableNumber };

	callServer(url, data, addTableCallback, alert);
}

function addTableCallback(response)
{
	if(response.status == 200)
	{
		fillTables(response);
	}
	else
	{
		alert(JSON.parse(response.responseText).message);
	}

	clearTableNumber();
}

function showTables()
{
	var url = 'index.php';
	var data = { op : 'showTables' };

	callServer(url, data, fillTables, alert);
}

function fillTables(response)
{
	jQuery(".tableList").html(response.responseText);
}

function addCustomerCallback(response)
{
	if(response.status == 200)
	{
		fillOrderDetails(response);
	}
	else
	{
		alert(JSON.parse(response.responseText).message);
	}

	clearCustomerNumber();
}

function clearTableNumber()
{
	jQuery(".tableNumber").val('');
	jQuery('.tableNumber').focus();
}

function clearCustomerNumber()
{
	jQuery('.customerNumber').val('');
	jQuery('.customerNumber').focus();
}

function payOrderCallback(response)
{
	showTables();
	fillOrderDetails({responseText : ''});
}

function fillOrderDetails(response)
{
	jQuery(".orderDetailsContent").html(response.responseText);
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
				}
  	});
}