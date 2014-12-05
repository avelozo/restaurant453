<?php

	require('../../config.php');
	include_once DIR_BASE . "business/employeeBS.php";
	
	$employeeBS = new EmployeeBS();

	if(isset($_POST['rel']) && $_POST['rel'] == "employeeStats")
	{

		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];

		$employeeStats = $employeeBS->getEmployeeStats($startDate, $endDate);
		//print_r(array_values($employeeStats));
		echo createTableBody($employeeStats);
	}
	else
	{
		include 'employeereport.html.php';
	}	

	function createTableBody($employeeStats)
	{
		$tableBody = '';

		foreach ($employeeStats as $employee)
		{
			$tableBody .= '<tr class="tableRow" valign="top">
				<td>' . $employee->id . '</td>
				<td>' . $employee->ssn . '</td>
				<td>' . $employee->lastName . '</td>
				<td>' . $employee->firstName . '</td>
				<td>' . $employee->email . '</td>
				<td>' . $employee->jobTitle . '</td>
				<td> $ ' . number_format ($employee->total, 2, '.', '') . '</td>
			</tr>';
		}

		return $tableBody;
	}
