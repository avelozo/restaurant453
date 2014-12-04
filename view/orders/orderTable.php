<?php

class OrderTableView
{
	private $orderBS;

	function OrderTableView($business)
	{
		$this->orderBS = $business;
	}

	function addTable($employeeId)
	{
		$tableNumber = $_POST['tableNumber'];

		$ret = $this->orderBS->addTable($employeeId, $tableNumber);

		if(is_array($ret))
		{
			header($ret['errorCode']);
	        header('Content-Type: application/json; charset=UTF-8');
	        die(json_encode($ret));
		}
		else
		{
			$this->showTables($employeeId);
		}
	}

	function showTables($employeeId)
	{
		$tableList = $this->createTableList($employeeId);

		echo $tableList;
	}

	function createTableList($employeeId)
	{
		$orders = $this->orderBS->getOrders(null, null, $employeeId);

		$tableList = '';

		foreach ($orders as $order)
		{
			$tableList .= '<input type="button" class="orderTableButton" onclick="showDetails(' . $order->id . ');" name="table" value="' . $order->tableNumber .'"><br>';
		}

		return $tableList;
	}
}