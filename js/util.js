function filterRestaurant(el, url, callback)
{
	getProductTableBody(url, jQuery(el).val(), callback);
}

function getProductTableBody(url, restaurantId, callback)
{
	jQuery.ajax({
	  type: "POST",
	  url: url,
	  data: { get: "table", restaurantId: restaurantId },
	  complete: function (response) {
	  	callback(response.responseText, url, restaurantId);
	  }
  	});
}



function fillTable(data, url, restaurantId)
{
	jQuery('.tableClass tbody').html(data);
}

function fillTableAndHead(data, url, restaurantId)
{
	jQuery('.tableClass tbody').html(data);

	jQuery.ajax({
	  type: "POST",
	  url: url,
	  data: { get: "head", restaurantId: restaurantId },
	  complete: function (response) {
	  	jQuery('.tableClass thead').html(response.responseText);
	  }
  	});
}

function transferToStock(productId)
{
	var restaurantId = jQuery('#restaurants').val();
    document.getElementById('mainForm').action = 'stock.php?productId=' + productId + '&restaurantId=' + restaurantId;
    document.getElementById('mainForm').submit();
}

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
	  	alert("vish");
   		alert(resp);
	}
  	});
}

$( document ).ready(function(){

	  $(".button-collapse").sideNav();
})

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

