<?php

class Order
{
	public $id;
	public $date;
	public $customer;
	public $tableNumber;
	public $employee;
	public $restaurant;
	public $orderDetails;
	public $endDate;

	function Product($id			= '',
				     $date			= '',
					 $customer		= '',
					 $tableNumber	= '',
					 $employee		= '',
					 $restaurant	= '',
					 $orderDetails	= '',
					 $endDate       = '')
	{
		$this->id			= $id;
		$this->date			= $date;
		$this->customer		= $customer;
		$this->tableNumber	= $tableNumber;
		$this->employee		= $employee;
		$this->restaurant	= $restaurant;
		$this->orderDetails	= $orderDetails;
		$this->endDate	    = $endDate;
	}
}