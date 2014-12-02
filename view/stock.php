<?php

	require('../config.php');
	include_once DIR_BASE . "business/productBS.php";
	include_once DIR_BASE . "business/restaurantBS.php";
	include_once DIR_BASE . "model/model.product.php";
	include_once DIR_BASE . "model/model.restaurant.php";

	$error = '';
	$productBS = new ProductBS();
	$restaurantBS = new RestaurantBS();
	$tableBody = '';

	$restaurants = $restaurants = $restaurantBS->getRestaurants();

	if (isset($_POST['action']) and $_POST['action'] == 'add')
	{	
		global $restaurants;
		$product = new Product();
		$product->id = $_POST['id'];
		$restaurantId = -1;
		
		if(isset($_POST['restaurantId']) && $_POST['restaurantId'] > 0)
			$restaurantId = $_POST['restaurantId'];

		$product->name = $_POST['name'];

		$pageTitle	= 'New Stock Entry';
		$action		= 'addform';

		include 'stock.form.php';
		exit();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'addform')
	{
		$product = new Product();
		$product->id = $_POST['id'];
		$product->restaurant = new Restaurant();
		$product->restaurant->id = $_POST['restaurants'];
		$product->buyPrice = $_POST['buyPrice'];
		$product->price = $_POST['price'];
		$product->quantityInStock = $_POST['quantity'];
		$product->saleTaxRate = $_POST['saleTaxRate'];

		$productBS->addProductStock($product);
	
		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		global $restaurants;

		$restaurantId = null;
		$product->name = $_POST['name'];

		$product = $productBS->getProducts($restaurantId, $_POST['id'])[0];
		
		$pageTitle	= 'Edit Stock Entry';
		$action		= 'editform';
		
		include 'stock.form.php';
		exit();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'editform')
	{

		print_r(array_values($_POST));
		$product = new Product();
		$product->id = $_POST['id'];
		$product->restaurant = new Restaurant();
		$product->restaurant->id = $_POST['restaurants'];
		$product->buyPrice = $_POST['buyPrice'];
		$product->price = $_POST['price'];
		$product->quantityInStock = $_POST['quantity'];
		$product->saleTaxRate = $_POST['saleTaxRate'];

		$productBS->updateProductStock($product);
	
		mainPage();
	}
	elseif (isset($_POST['get']) and $_POST['get'] == 'table')
	{
		$resturantId = $_POST['restaurantId'] > 0 ? $_POST['restaurantId'] : null;
		$products = $productBS->getProducts($resturantId);
		echo createTableBody($products, $resturantId);
	}
	elseif (isset($_POST['get']) and $_POST['get'] == 'head')
	{
		$resturantId = $_POST['restaurantId'] > 0 ? $_POST['restaurantId'] : null;
		
		echo createTableHead($resturantId);
	}
	else
	{
		$restaurantId = null;
		$productId = null;

		if(isset($_GET['restaurantId']))
			$restaurantId = $_GET['restaurantId'];

		if(isset($_GET['productId']))
			$productId = $_GET['productId'];

		mainPage($restaurantId, $productId);
	}
	
	function mainPage($restaurantId = null, $productId = null)
	{	
		global $productBS, $products, $restaurantBS, $restaurants, $error, $deleteMsg, $deleteUrl;
		global $tableBody;

		// Display product list
		$products = $productBS->getProducts($restaurantId, $productId);
		$tableBody = createTableBody($products, $restaurantId);
		$tableHead = createTableHead($restaurantId);

		include 'stock.html.php';
	}

	function createTableBody($products, $restaurantId)
	{
		$tableBody = '';
		global $deleteMsg, $deleteUrl;
		foreach ($products as $product)
		{
			$tableBody .= '<tr class="tableRow" valign="top">
				<td>' . $product->restaurant->name . '</td>
				<td>' . $product->name . '</td>';
			if($restaurantId != null && $restaurantId > 0)
				$tableBody .= '<td>' . $product->buyPrice . '</td>
					<td>' . $product->price . '</td>
					<td>' . $product->quantityInStock . '</td>
					<td>' . $product->saleTaxRate . '</td> ';

			$tableBody .= '<td>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="' .  $product->id . '">
							<input type="hidden" name="name" value="' .  $product->name . '">';
			
			if($restaurantId != null && $restaurantId > 0)
				$tableBody .= '<input type="hidden" name="restaurantId" value="' .  $restaurantId . '">
								<input type="submit" name="action" value="iedit">';
			
			$tableBody .= '	<input type="submit" name="action" value="add">
						</div>
					</form>
				</td>
			</tr>';
		}

		return $tableBody;
	}

	function createTableHead($restaurantId)
	{
		$tableHead = '';
		
		$tableHead .= '<tr class= "tableRowHeader">
				<th>Restaurant</th>
				<th>Product</th>';
		if($restaurantId != null && $restaurantId > 0)
			$tableHead .= '<th>Buy Price</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Sale Tax Rate</th>';
		$tableHead .= '<th>Options</th>
						</tr>';
		

		return $tableHead;
	}
