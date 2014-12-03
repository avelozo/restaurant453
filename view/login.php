<?php

	require('../config.php');
	require_once DIR_BASE . '/business/employeeBS.php';

	$login = $_POST['username'];
	$pass = $_POST['password'];

	$employeeBusiness = new EmployeeBS();
	$authenticated = $employeeBusiness->authenticate($login, $pass);

	if($authenticated)
	{
		echo 	"<h1>Logged in as user:</h1>" .
		"<pre>" . print_r( $login, true ) . "<pre>";
	}
	else
	{
		echo 	"<h1>Invalid login!</h1>" .
		"<pre>" . print_r( $login, true ) . "<pre>";
	}
