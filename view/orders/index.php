<?php

	require('../../config.php');
	include_once DIR_BASE . "business/orderBS.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";
	include_once DIR_BASE . "view/orders/orderdetail.php";

	$orderBS = new OrderBS();

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
	else
	{
		include 'orders.html.php';
		exit();
	}

	

	