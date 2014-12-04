<?php  
class EmployeeStats
{
	public $id;
	public $ssn;
	public $lastName;
	public $firstName;
	public $email;
	public $jobTitle;
	public $userName;
	public $password;
	public $total;

	

	function Employee($id			= '',
				     $ssn			= '',
					 $lastName		= '',
					 $firstName		= '',
					 $email			= '',
					 $jobTitle		= '',
					 $userName		= '',
					 $password		= '',
					 $total			= '')
	{	
		$this->id			= $id;
		$this->ssn			= $ssn;
		$this->lastName		= $lastName;
		$this->firstName	= $firstName;
		$this->email		= $email;
		$this->jobTitle		= $jobTitle;
		$this->userName		= $userName;
		$this->password		= $password;
		$this->total		= $total;
	}


	
}