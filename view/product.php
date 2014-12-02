<?php

	require('../config.php');
	include_once DIR_BASE . "business/productBS.php";
	include_once DIR_BASE . "business/restaurantBS.php";
	include_once DIR_BASE . "model/model.product.php";

	$error = '';
	$productBS = new ProductBS();
	$restaurantBS = new RestaurantBS();
	$deleteMsg = 'Do you want to delete this product: ';
	$deleteUrl = 'product.php';
	$tableBody = '';

	if (isset($_POST['add']))
	{
		$product = new Product();

		$action	= 'addform';

		include 'product.form.php';
		exit();
	}
	elseif (isset($_GET['addform']))
	{
		$product = new Product(null,
						 $_POST['name'],
						 $_POST['vendor'],
						 $_POST['description']);

		$productBS->addProduct($product);
	
		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$product = $productBS->getProducts(null, $_POST['id'])[0];

		$action	= 'editform';
		
		include 'product.form.php';
		exit();
	}
	elseif (isset($_GET['editform']))
	{
		$product = new Product($_POST['id'],
						 $_POST['name'],
						 $_POST['vendor'],
						 $_POST['description']);

		$productBS->updateProduct($product);
	
		mainPage();
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$error = $productBS->deleteProduct($_POST['id']);

		mainPage();
	}
	elseif (isset($_POST['get']) and $_POST['get'] == 'table')
	{
		$resturantId = $_POST['restaurantId'] > 0 ? $_POST['restaurantId'] : null;
		$products = $productBS->getProducts($resturantId);
		echo createTableBody($products);
	}
	else
	{
		mainPage();
	}
	
	function mainPage()
	{	
		global $productBS, $products, $restaurantBS, $restaurants, $error, $deleteMsg, $deleteUrl;
		global $tableBody;

		$restaurants = $restaurantBS->getRestaurants();
		// Display product list
		$products = $productBS->getProducts();
		$tableBody = createTableBody($products);
		
		include 'product.html.php';
	}

	function createTableBody($products)
	{
		$tableBody = '';
		global $deleteMsg, $deleteUrl;
		foreach ($products as $product)
		{
			$tableBody .= '<tr class="tableRow" valign="top">
				<td>' . $product->id . '</td>
				<td>' . $product->name . '</td>
				<td>' . $product->vendor . '</td>
				<td>' . $product->description . '</td>
				<td>
					<form action="?" method="post" id="mainForm">
						<div>
							<input type="hidden" name="id" value="' .  $product->id . '">
							<input type="submit" name="action" value="iedit">
							<input type="button" onclick="confirmDelete(\'' . $deleteMsg . $product->name . '?\', \'' . $deleteUrl . '\', ' . $product->id .', getProductTableBody, fillTable )" name="delete" value="idelete">
							<input type="submit" name="action" onclick="transferToStock(' .  $product->id . ')" value="editStock">
						</div>
					</form>
				</td>
			</tr>';
		}

		return $tableBody;
	}
