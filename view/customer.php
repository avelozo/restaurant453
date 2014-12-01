<?php

	require('../config.php');
	include_once DIR_BASE . "business/customerBS.php";
	include_once DIR_BASE . "model/model.customer.php";

	$customerBS = new CustomerBS();
	
	if (isset($_POST['add']))
	{
		$customer = new Customer();

		$pageTitle	= 'New Customer';
		$action		= 'addform';

		include 'customer.form.php';
		exit();
	}

	if (isset($_GET['addform']))
	{
		echo $_POST['name']. $_POST['phone'] . $_POST['addressLine1'];
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
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$customer = $customerBS->getCustomers($_POST['id'])[0];

		$pageTitle	= 'Edit Customer';
		$action		= 'editform';
		
		include 'customer.form.php';
		exit();
	}

	if (isset($_GET['editform']))
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
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$customerBS->deleteCustomer($_POST['id']);

		header('Location: .');
		exit();
	}

	// Display customer list
	$customers = $customerBS->getCustomers();
	
	include 'customer.html.php';
