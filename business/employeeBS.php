<?php

	require_once '../mapper/employeeMapper.php';
	require_once 'api.password.php';
	
	class EmployeeBS
	{
		private $employeeMapper;

		function EmployeeBS()
		{
			$this->employeeMapper = new EmployeeMapper();
		}

		function Authenticate($login, $password)
		{	
			$employees = $this->employeeMapper->getEmployees(null, $login);
			
			if(count($employees) > 0 && password_verify($password, $employees[0]->password))
			{
				if(password_needs_rehash($employees[0]->password, PASSWORD_BCRYPT))
				{
					$employees[0]->password = password_hash($password, PASSWORD_BCRYPT);
					$this->employeeMapper->updateEmployee($employees[0]);
				}

				return true;
			}
			else
			{
				return false;
			}
		}
	}