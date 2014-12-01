<?php

	require('../config.php');
	include_once DIR_BASE . "business/productBS.php";
	include_once DIR_BASE . "model/model.product.php";

	$error = '';
	$productBS = new ProductBS();
	$deleteMsg = 'Do you want to delete this product: ';
	$deleteUrl = 'product.php';

	if (isset($_POST['add']))
	{
		$product = new Product();

		$pageTitle	= 'New Product';
		$action		= 'addform';

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

		$pageTitle	= 'Edit Product';
		$action		= 'editform';
		
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
	}
	else
	{
		mainPage();
	}
	
	function mainPage()
	{	
		global $productBS, $products, $error, $deleteMsg, $deleteUrl;

		// Display product list
		$products = $productBS->getProducts();
		
		include 'product.html.php';
	}
