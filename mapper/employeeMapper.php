<?php

	include_once DIR_BASE . "dataaccess/employeeDA.php";
	include_once DIR_BASE . "model/model.employee.php";
	include_once DIR_BASE . "mapper/restaurantMapper.php";
	include_once DIR_BASE . "mapper/roleMapper.php";

	class EmployeeMapper
	{
		private $employeeDAO = null;
		private $roleMapper;
		private $restaurantMapper;

		function EmployeeMapper()
		{
			$this->employeeDAO = new EmployeeDA();
			$this->roleMapper = new RoleMapper();
			$this->restaurantMapper = new RestaurantMapper();
		}

		public function getEmployees($id = null, $userName = null, $connection = null)
		{
			$employeeRet = [];

			$employees = $this->employeeDAO->getEmployees($id, $userName);

			foreach ($employees as $employee)
			{
				array_push($employeeRet, $this->createEmployee($employee));
			}

			return $employeeRet;
		}

		public function addEmployee($employee)
		{
			$this->employeeDAO->addEmployee($employee);
		}

		public function updateEmployee($employee)
		{
			$this->employeeDAO->updateEmployee($employee);
		}

		private function createEmployee($employee)
		{
			$emp = new Employee();

			$emp->id = $employee['employeeId'];
			$emp->ssn = $employee['employeeSSN'];
			$emp->lastName = $employee['employeeLastName'];
			$emp->firstName = $employee['employeeFirstName'];
			$emp->email = $employee['employeeEmail'];
			$emp->restaurant = $this->restaurantMapper->createRestaurant($employee);
			$emp->reportsTo = $this->createSupervisor($employee);
			$emp->jobTitle = $employee['employeeJobTitle'];
			$emp->userName = $employee['employeeUserName'];
			$emp->password = $employee['employeePassword'];
			$emp->role = $this->roleMapper->createRole($employee);

			return $emp;
		}

		private function createSupervisor($employee)
		{
			$emp = new Employee();

			$emp->id = $employee['supervisorId'];
			$emp->ssn = $employee['supervisorSSN'];
			$emp->lastName = $employee['supervisorLastName'];
			$emp->firstName = $employee['supervisorFirstName'];
			$emp->email = $employee['supervisorEmail'];
			$emp->restaurant = $this->restaurantMapper->createRestaurant($employee);			
			$emp->jobTitle = $employee['supervisorJobTitle'];
			$emp->userName = $employee['supervisorUserName'];
			$emp->password = $employee['supervisorPassword'];
			$emp->role = $this->roleMapper->createRole($employee);

			return $emp;
		}
	}

