<?php

	require('../config.php');
	include_once DIR_BASE . "business/restaurantBS.php";
	include_once DIR_BASE . "model/model.restaurant.php";

	$restaurantBS = new restaurantBS();
	
	if (isset($_GET['add']))
	{
		$restaurant = new Restaurant();

		$pageTitle	= 'New Restaurant';
		$action		= 'addform';
		$button		= 'Add restaurant';

		include 'restaurant.form.php';
		exit();
	}

	if (isset($_GET['addform']))
	{
		$restaurant = new Restaurant(null,
									 $_POST['name'],
									 $_POST['phone'],
									 $_POST['addressLine1'],
									 $_POST['addressLine2'],
									 $_POST['city'],
									 $_POST['state'],
									 $_POST['country'],
									 $_POST['postalCode']);
		$restaurantBS->addRestaurant($restaurant);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Edit')
	{
		$restaurant = $restaurantBS->getRestaurants($_POST['id'])[0];

		$pageTitle	= 'Edit Restaurant';
		$action		= 'editform';
		$button		= 'Update restaurant';

		include 'restaurant.form.php';
		exit();
	}

	if (isset($_GET['editform']))
	{
		$restaurant = new Restaurant($_POST['id'],
									 $_POST['name'],
									 $_POST['phone'],
									 $_POST['addressLine1'],
									 $_POST['addressLine2'],
									 $_POST['city'],
									 $_POST['state'],
									 $_POST['country'],
									 $_POST['postalCode']);
		$restaurantBS->updateRestaurant($restaurant);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Delete')
	{
		$restaurantBS->deleteRestaurant($_POST['id']);

		header('Location: .');
		exit();
	}

	// Display restaurant list
	$restaurants = $restaurantBS->getRestaurants();
	
	include 'restaurant.html.php';
