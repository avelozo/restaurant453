<?php

class OrderStats
{
	public $orderDate;
	public $orderQuantity;
	public $orderPriceTotal;
	public $averageTicket;
	public $averagePriceTotal;
	public $averageAverageTicket;
	public $priceTotalAboveAverage;
	public $averageTicketAboveAverage;

	function Product($orderDate					= '',
				     $orderQuantity				= '',
					 $orderPriceTotal			= '',
					 $averageTicket				= '',
					 $averagePriceTotal			= '',
					 $averageAverageTicket		= '',
					 $priceTotalAboveAverage	= '',
					 $averageTicketAboveAverage	= '')
	{
		$this->orderDate					= $orderDate;
		$this->orderQuantity				= $orderQuantity;
		$this->orderPriceTotal				= $orderPriceTotal;
		$this->averageTicket				= $averageTicket;
		$this->averagePriceTotal			= $averagePriceTotal;
		$this->averageAverageTicket			= $averageAverageTicket;
		$this->priceTotalAboveAverage		= $priceTotalAboveAverage;
		$this->averageTicketAboveAverage	= $averageTicketAboveAverage;
	}
}