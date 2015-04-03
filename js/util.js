jQuery(document).ready(function()
{
	jQuery('.menuExpandCollapse').on('click', expandCollapseMenu);
});


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
/*
function expandCollapseMenu()
{
	 // Set the effect type
    var effect = 'slide';

    // Set the options for the effect type chosen
    var options = { direction: 'left' };

    var el = '.menuExpandCollapse';

    jQuery('.leftPanel').toggle(options);
    if(jQuery(el).text() == '+')
    	jQuery(el).text('-');
    else
    	jQuery(el).text('+');

	event.stopPropagation();
    event.preventDefault();

    return false;
}*/

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