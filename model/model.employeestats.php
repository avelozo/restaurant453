<?php  
class EmployeeStats
{
	public $id;
	public $ssn;
	public $lastName;
	public $firstName;
	public $email;
	public $jobTitle;
	public $total;

	

	function Employee($id			= '',
				     $ssn			= '',
					 $lastName		= '',
					 $firstName		= '',
					 $email			= '',
					 $jobTitle		= '',
					 $total			= '')
	{	
		$this->id			= $id;
		$this->ssn			= $ssn;
		$this->lastName		= $lastName;
		$this->firstName	= $firstName;
		$this->email		= $email;
		$this->jobTitle		= $jobTitle;
		$this->total		= $total;
	}


	
}