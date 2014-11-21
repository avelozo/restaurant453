<?php

class OrderDetail
{
	public $order;
	public $product;
	public $quantityOrdered;
	public $priceEach;
	public $chair;

	function Product($order				= '',
				     $product			= '',
					 $quantityOrdered	= '',
					 $priceEach			= '',
					 $chair				= '')
	{
		$this->order			= $order;
		$this->product			= $product;
		$this->quantityOrdered	= $quantityOrdered;
		$this->priceEach		= $priceEach;
		$this->chair			= $chair;
	}
}