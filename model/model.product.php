<?php

class Product
{
	public $id;
	public $name;
	public $vendor;
	public $description;
	public $buyPrice;
	public $price;
	public $restaurant;
	public $quantityInStock;

	function Product($id				= '',
				     $name				= '',
					 $vendor			= '',
					 $description		= '',
					 $buyPrice			= '',
					 $price				= '',
					 $restaurant		= '',
					 $quantityInStock	= '')
	{
		$this->id				= $id;
		$this->name				= $name;
		$this->vendor			= $vendor;
		$this->description		= $description;
		$this->buyPrice			= $buyPrice;
		$this->price			= $price;
		$this->restaurant		= $restaurant;
		$this->quantityInStock	= $quantityInStock;
	}
}