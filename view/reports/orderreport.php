<?php

	require('../../config.php');
	include_once DIR_BASE . "business/orderBS.php";
	
	$orderBS = new OrderBS();

	if(isset($_POST['rel']) && $_POST['rel'] == "orderStats")
	{

		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];

		$orderStats = $orderBS->getOrderStats($startDate, $endDate);
		//print_r(array_values($orderStats));
		echo createTableBody($orderStats);
	}
	else
	{
		include 'orderreport.html.php';
	}	

	function createTableBody($orderStats)
	{
		$tableBody = '';

		foreach ($orderStats as $order)
		{
			$tableBody .= '<tr class="tableRow" valign="top">
				<td>' . $order->orderDate . '</td>
				<td>' . $order->orderQuantity . '</td>
				<td>' . $order->orderPriceTotal . '</td>
				<td>' . $order->averageTicket . '</td>
				<td>' . $order->averagePriceTotal . '</td>
				<td>' . $order->averageAverageTicket . '</td>
				<td>' . $order->priceTotalAboveAverage . '</td>
				<td>' . $order->averageTicketAboveAverage . '</td>
			</tr>';
		}

		return $tableBody;
	}
