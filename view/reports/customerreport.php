<?php

	require('../../config.php');
	include_once DIR_BASE . "business/customerBS.php";
	
	$customerBS = new CustomerBS();

	if(isset($_POST['rel']) && $_POST['rel'] == "customerStats")
	{

		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$minValue = $_POST['minValue'];

		$customerStats = $customerBS->getCustomerStats($startDate, $endDate, $minValue);
		print_r(array_values($customerStats));
		echo createTableBody($customerStats);
	}
	else
	{
		include 'customerreport.html.php';
	}	

	function createTableBody($customerStats)
	{
		$tableBody = '';

		foreach ($customerStats as $customer)
		{
			$tableBody .= '<tr class="tableRow" valign="top">
				<td>' . $customer->id . '</td>
				<td>' . $customer->name . '</td>
				<td>' . $customer->phone . '</td>
				<td>' . $customer->addressLine1 . '</td>
				<td>' . $customer->addressLine2 . '</td>
				<td>' . $customer->city . '</td>
				<td>' . $customer->state . '</td>
				<td>' . $customer->country . '</td>
				<td>' . $customer->postalCode . '</td>
			</tr>';
		}

		return $tableBody;
	}
