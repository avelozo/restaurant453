<?php

	require('../config.php');
	include_once DIR_BASE . "business/customerBS.php";
	include_once DIR_BASE . "model/model.customer.php";

	$error = '';
	$customerBS = new CustomerBS();
	$deleteMsg = 'Do you want to delete this customer: ';
	$deleteUrl = 'customer.php';
	
	if (isset($_POST['add']))
	{
		$customer = new Customer();

		$action	= 'addform';

		include 'customer.form.php';
		exit();
	}
	elseif (isset($_GET['addform']))
	{
		$customer = new Customer(null,
						 $_POST['name'],
						 $_POST['phone'],
						 $_POST['addressLine1'],
						 $_POST['addressLine2'],
						 $_POST['city'],
						 $_POST['state'],
						 $_POST['country'],
						 $_POST['postalCode']);

		$customerBS->addCustomer($customer);
	
		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$customer = $customerBS->getCustomers($_POST['id'])[0];

		$action	= 'editform';
		
		include 'customer.form.php';
		exit();
	}
	elseif (isset($_GET['editform']))
	{
		$customer = new Customer(null,
						 $_POST['name'],
						 $_POST['phone'],
						 $_POST['addressLine1'],
						 $_POST['addressLine2'],
						 $_POST['city'],
						 $_POST['state'],
						 $_POST['country'],
						 $_POST['postalCode']);

		$customerBS->updateCustomer($customer);
	
		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$error = $customerBS->deleteCustomer($_POST['id']);

		mainPage();
	}
	else
	{
		mainPage();
	}

	function mainPage()
	{	
		global $customerBS, $customers, $error, $deleteMsg, $deleteUrl;

		// Display customer list
		$customers = $customerBS->getCustomers();
	
		include 'customer.html.php';
	}
