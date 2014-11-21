<?php

class Employee
{
	public $id;
	public $ssn;
	public $lastName;
	public $firstName;
	public $email;
	public $restaurant;
	public $reportsTo;
	public $jobTitle;
	public $userName;
	public $password;
	public $role;

	function Product($id			= '',
				     $ssn			= '',
					 $lastName		= '',
					 $firstName		= '',
					 $email			= '',
					 $restaurant	= '',
					 $reportsTo		= '',
					 $jobTitle		= '',
					 $userName		= '',
					 $password		= '',
					 $role			= '')
	{
		$this->id			= $id;
		$this->ssn			= $ssn;
		$this->lastName		= $lastName;
		$this->firstName	= $firstName;
		$this->email		= $email;
		$this->restaurant	= $restaurant;
		$this->reportsTo	= $reportsTo;
		$this->jobTitle		= $jobTitle;
		$this->userName		= $userName;
		$this->password		= $password;
		$this->role			= $role;
	}
}