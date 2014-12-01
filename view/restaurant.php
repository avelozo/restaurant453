<?php

	require('../config.php');
	include_once DIR_BASE . "business/restaurantBS.php";
	include_once DIR_BASE . "model/model.restaurant.php";

	$error = '';
	$restaurantBS = new restaurantBS();
	
	if (isset($_GET['add']))
	{
		$restaurant = new Restaurant();

		$action	= 'addform';

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

		$error = $restaurantBS->addRestaurant($restaurant);
	}

	if (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$restaurant = $restaurantBS->getRestaurants($_POST['id'])[0];

		$action	= 'editform';

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

		$error = $restaurantBS->updateRestaurant($restaurant);
	}

	if (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$error = $restaurantBS->deleteRestaurant($_POST['id']);
	}

	// Display restaurant list
	$restaurants = $restaurantBS->getRestaurants();
	
	include 'restaurant.html.php';
