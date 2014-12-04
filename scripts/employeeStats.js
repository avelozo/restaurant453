jQuery(function() {
	if(jQuery( "#employeeStartDate" ).length > 0)
	{
		jQuery( "#employeeEndDate" ).datepicker();
	    jQuery( "#employeeStartDate" ).datepicker();

	    jQuery( "#employeeEndDate" ).datepicker("setDate", new Date());
	    jQuery( "#employeeStartDate" ).datepicker("setDate", -29);

	    jQuery( "#employeeEndDate" ).datepicker('option', "dateFormat", "mm/dd/yy");
	    jQuery( "#employeeStartDate" ).datepicker('option', "dateFormat", "mm/dd/yy");

	    jQuery( "#employeeStartDate" ).on('change', loadEmployeeReport);
	    jQuery( "#employeeEndDate" ).on('change', loadEmployeeReport);

	    loadEmployeeReport();
	}
});

function loadEmployeeReport()
{
	var startDate = jQuery( "#employeeStartDate" ).val();
	var endDate = jQuery( "#employeeEndDate" ).val();

	var data = { rel : 'employeeStats' , startDate : startDate , endDate : endDate };

	callServer('employeereport.php', data, fillEmployeeReport, alert);
}

function fillEmployeeReport(response)
{
	jQuery('.tableClass tbody').html(response.responseText);
}