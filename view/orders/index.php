<?php

	require('../../config.php');
	include_once DIR_BASE . "business/orderBS.php";
	include_once DIR_BASE . "business/productBS.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "view/orders/orderdetail.php";
	include_once DIR_BASE . "model/model.product.php";
	include_once DIR_BASE . "view/orders/ordertable.php";
	include_once DIR_BASE . "view/orders/orderProduct.php";

	$orderBS = new OrderBS();
	$productBS= new ProductBS();

	session_start();

	if(isset($_GET['employeeId']))
	{
		$_SESSION['employeeId'] = $_GET['employeeId'];
	}

	$employeeId = $_SESSION['employeeId'];

	// Tables
	if(isset($_POST['op']) && $_POST['op'] == 'showTables')
	{
		$orderTable = new OrderTableView($orderBS);
		$orderTable->showTables($employeeId);
	}
	elseif(isset($_POST['op']) && $_POST['op'] == 'addTable')
	{
		$orderTable = new OrderTableView($orderBS);
		$orderTable->addTable($employeeId);
	}
	// Details
	elseif(isset($_POST['op']) && $_POST['op'] == 'showDetails')
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->showDetails();
	}
	elseif (isset($_POST['op']) && $_POST['op'] == 'payOrder') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->payOrder();
	}
	elseif (isset($_POST['op']) && $_POST['op'] == 'addCustomer') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->addCustomer();
	}
	// Products
	elseif (isset($_POST['op']) && $_POST['op'] == 'chooseProduct') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->chooseProduct();
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'showProducts') 
	{
		$orderProduct = new OrderProduct($orderBS, $productBS);
		$orderProduct->showProducts();
	}
	else
	{
		include 'orders.html.php';
		exit();
	}

	
	

	