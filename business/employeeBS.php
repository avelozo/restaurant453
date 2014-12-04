<?php

	require_once DIR_BASE . 'mapper/employeeMapper.php';
	require_once 'api.password.php';
	
	class EmployeeBS
	{
		private $employeeMapper;

		function EmployeeBS()
		{
			$this->employeeMapper = new EmployeeMapper();
		}


		public function Authenticate($login, $password)
		{	
			$employees = $this->employeeMapper->getEmployees(null, $login);

			if(count($employees) ==  0 || !password_verify($password, $employees[0]->password))
			{
				return false;
			}
			else
			{
				if(password_needs_rehash($employees[0]->password, PASSWORD_BCRYPT))
				{
					$employees[0]->password = password_hash($password, PASSWORD_BCRYPT);
					$this->employeeMapper->updateEmployee($employees[0]);
				}

				return $employees[0];
			}
		}

		public function getEmployees($id = null)
		{
			return $this->employeeMapper->getEmployees($id);
		}

		public function getEmployeeStats($startDate, $endDate)
		{
			$time = strtotime($startDate);
			$startDate = date('Y-m-d',$time);

			$time = strtotime($endDate);
			$endDate = date('Y-m-d',$time);

			return $this->employeeMapper->getEmployeeStats($startDate, $endDate);
		}

		public function addEmployee($employee)
		{
			$employee->password = password_hash($employee->password, PASSWORD_BCRYPT);
			return $this->employeeMapper->addEmployee($employee);
		}

		public function updateEmployee($employee)
		{
			$employee->password = password_hash($employee->password, PASSWORD_BCRYPT);
			return $this->employeeMapper->updateEmployee($employee);
		}
		
		public function deleteEmployee($id)
		{
			return $this->employeeMapper->deleteEmployee($id);
		}
		

	}