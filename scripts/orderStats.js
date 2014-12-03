jQuery(function() {
	if(jQuery( "#startDate" ).length > 0)
	{
		jQuery( "#endDate" ).datepicker();
	    jQuery( "#startDate" ).datepicker();

	    jQuery( "#endDate" ).datepicker("setDate", new Date());
	    jQuery( "#startDate" ).datepicker("setDate", -29);

	    jQuery( "#endDate" ).datepicker('option', "dateFormat", "mm/dd/yy");
	    jQuery( "#startDate" ).datepicker('option', "dateFormat", "mm/dd/yy");

	    jQuery( "#startDate" ).on('change', loadReport);
	    jQuery( "#endDate" ).on('change', loadReport);

	    loadReport();
	}
});

function loadReport()
{
	var startDate = jQuery( "#startDate" ).val();
	var endDate = jQuery( "#endDate" ).val();

	var data = { rel : 'orderStats' , startDate : startDate , endDate : endDate };

	callServer('orderreport.php', data, fillReport, alert);
}

function fillReport(response)
{
	jQuery('.tableClass tbody').html(response.responseText);
}