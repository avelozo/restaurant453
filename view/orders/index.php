<?php

	require('../../config.php');
	include_once DIR_BASE . "business/orderBS.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "view/orders/orderdetail.php";
	include_once DIR_BASE . "model/model.product.php";
	include_once DIR_BASE . "view/orders/orderProduct.php";

	$orderBS = new OrderBS();
	$productBS= new Product();

	if(isset($_POST['op']) and $_POST['op'] == 'showDetails')
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->showDetails();
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'payOrder') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->payOrder();
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'addCustomer') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->addCustomer();
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'chooseProduct') 
	{
		$orderDetail = new OrderDetailView($orderBS);
		$orderDetail->chooseProduct();
	}elseif (isset($_POST['op']) and $_POST['op'] == 'showProducts') 
	{
		$orderProduct = new OrderProduct($orderBS,$productBS);
		$orderProduct->showProducts();
	}
	else
	{
		include 'orders.html.php';
		exit();
	}

	
	