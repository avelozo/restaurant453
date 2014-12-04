<?php

	if(isset($_POST['username']))
	{
		require_once('../config.php');
		require_once DIR_BASE . '/business/employeeBS.php';

		$login = $_POST['username'];
		$pass = $_POST['password'];

		$employeeBusiness = new EmployeeBS();
		$authenticated = $employeeBusiness->authenticate($login, $pass);

		if($authenticated == false)
		{
			
			echo 	"<h1>Invalid login!</h1>";
			
			include DIR_BASE . '/view/login.html';
		}
		else
		{
			$_SESSION['UserId'] = $authenticated->id;
			$_SESSION['Role'] = $authenticated->role->name;

			if($authenticated->role->name == 'Operator')
			{
				header("Location: " . ROOT . '/view/orders/');
  
  				exit();
			}
		}
	}
	else
	{
		include DIR_BASE . '/view/login.html';
	}

