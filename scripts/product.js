function filterRestaurant(el, url, callback)
{
	if(typeof callback == undefined)
		callback = fillTable;

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

function fillTable(data)
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
