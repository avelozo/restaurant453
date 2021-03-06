<?php

	require('../config.php');
	include_once DIR_BASE . '/business/employeeBS.php';
	include_once DIR_BASE . '/business/restaurantBS.php';
	include_once DIR_BASE . '/business/roleBS.php';
	include_once DIR_BASE . 'model/model.employee.php';

	$error = '';
	$employeeBS = new EmployeeBS();
	$restaurantBS = new RestaurantBS();
	$roleBS= new RoleBS();
	$deleteMsg = 'Do you want to delete this employee: ';
	$deleteUrl = 'employee.php';

	$employees = $employeeBS->getEmployees();
	$restaurants = $restaurantBS->getRestaurants();
	$roles= $roleBS->getRoles();

	if (isset($_POST['add']))
	{
		$employee = new Employee();

		$action	= 'addform';

		include 'employee.form.php';
		exit();
	}
	elseif (isset($_GET['addform']))
	{
		$restaurant = new Restaurant($_POST['restaurant']);
		if ($_POST['reportsTo'] == '')
			$reportsTo= null;
		else
			$reportsTo= new Employee($_POST['reportsTo']);
		$role = new Role($_POST['role']);
		$employee = new Employee(null,
						 $_POST['ssn'],
						 $_POST['lastName'],
						 $_POST['firstName'],
						 $_POST['email'],
						 $restaurant,
						 $reportsTo,
						 $_POST['jobTitle'],
						 $_POST['userName'],
						 $_POST['password'],
						 $role
						 );

		$error = $employeeBS->addEmployee($employee);

		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$employee = $employeeBS->getEmployees($_POST['id'])[0];
		$action	= 'editform';
		
		include 'employee.form.php';
		exit();
	}
	elseif (isset($_GET['editform']))
	{
		$restaurant = new Restaurant($_POST['restaurant']);
		if ($_POST['reportsTo'] == '')
			$reportsTo= null;
		else
			$reportsTo= new Employee($_POST['reportsTo']);
		$role = new Role($_POST['role']);
		$employee = new Employee($_POST['id'],
						 $_POST['ssn'],
						 $_POST['lastName'],
						 $_POST['firstName'],
						 $_POST['email'],
						 $restaurant,
						 $reportsTo,
						 $_POST['jobTitle'],
						 $_POST['userName'],
						 $_POST['password'],
						 $role
						 );

		$error = $employeeBS->updateEmployee($employee);

		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$error = $employeeBS->deleteEmployee($_POST['id']);

		mainPage();
	}
	else
	{
		mainPage();
	}

	function mainPage()
	{	
		global $employeeBS, $employees, $error, $deleteMsg, $deleteUrl;

		// Display customer list
		$employees = $employeeBS->getEmployees();
		include 'employee.html.php';
	}
