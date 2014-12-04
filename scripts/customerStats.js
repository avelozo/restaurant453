jQuery(function() {
	if(jQuery( "#customerStartDate" ).length > 0)
	{
		jQuery( "#customerEndDate" ).datepicker();
	    jQuery( "#customerStartDate" ).datepicker();

	    jQuery( "#customerEndDate" ).datepicker("setDate", new Date());
	    jQuery( "#customerStartDate" ).datepicker("setDate", -29);

	    jQuery( "#customerEndDate" ).datepicker('option', "dateFormat", "mm/dd/yy");
	    jQuery( "#customerStartDate" ).datepicker('option', "dateFormat", "mm/dd/yy");

	    jQuery( "#customerStartDate" ).on('change', loadCustomerReport);
	    jQuery( "#customerEndDate" ).on('change', loadCustomerReport);
	    jQuery( "#customerMinValue" ).on('change', loadCustomerReport);

	    loadCustomerReport();
	}
});

function loadCustomerReport()
{
	var startDate = jQuery( "#customerStartDate" ).val();
	var endDate = jQuery( "#customerEndDate" ).val();
	var minValue = jQuery( "#customerMinValue" ).val();

	var data = { rel : 'customerStats' , startDate : startDate , endDate : endDate , minValue : minValue };

	callServer('customerreport.php', data, fillCustomerReport, alert);
}

function fillCustomerReport(response)
{
	jQuery('.tableClass tbody').html(response.responseText);
}