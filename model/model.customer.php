<?php

class Customer
{
	public $id;
	public $name;
	public $phone;
	public $addressLine1;
	public $addressLine2;
	public $city;
	public $state;
	public $country;
	public $postalCode;

	function Product($id			= '',
				     $name			= '',
					 $phone			= '',
					 $addressLine1	= '',
					 $addressLine2	= '',
					 $city			= '',
					 $state			= '',
					 $country		= '',
					 $postalCode	= '')
	{
		$this->id			= $id;
		$this->name			= $name;
		$this->phone		= $phone;
		$this->addressLine1	= $addressLine1;
		$this->addressLine2	= $addressLine2;
		$this->city			= $city;
		$this->state		= $state;
		$this->country		= $country;
		$this->postalCode	= $postalCode;
	}
}