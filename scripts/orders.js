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
	showProducts(orderId);
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
	fillProductDetails({responseText : ''});
}

function fillOrderDetails(response)
{
	jQuery(".orderDetailsContent").html(response.responseText);
}

function showProducts(orderId)
{
	var url = 'index.php';
	var data = { op : 'showProducts', orderId : orderId };

	callServer(url, data, fillProductDetails, alert);
}

function addProducts(orderId)
{
	var url = 'index.php';
	var productQuantity = jQuery(".productQuantity").val();
	var chair = jQuery(".chair").val();
	var productId = jQuery(".productId:checked").val();
	

	if(productId !== undefined && productQuantity !== undefined && productQuantity.trim().length > 0)
	{
		var data = { op : 'addProducts', orderId : orderId, productQuantity : productQuantity, chair : chair, productId : productId };
		callServer(url, data, function (response) { processAdd(response, orderId); }, alert);
	}
	else
	{
		alert('Please select one product and enter quantity.');
	}
}

function processAdd(response, orderId)
{
	if(response.responseText.length == 0 && response.status == 200)
	{
		showDetails(orderId);
	}
	else
	{
		alert('Insufficient stock. Cannot sell this quantity.');
	}
	jQuery(".productQuantity").val("");
	jQuery(".chair").val("");
	jQuery(".productId:checked").prop("checked", false);
}

function fillProductDetails(response)
{
	jQuery(".orderProductsList").html(response.responseText);
}
