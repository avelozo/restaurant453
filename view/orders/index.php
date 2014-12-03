<?php

	require('../../config.php');
	include_once DIR_BASE . "business/orderBS.php";
	include_once DIR_BASE . "model/model.order.php";
	include_once DIR_BASE . "model/model.orderdetail.php";

	$orderBS = new OrderBS();

	if(isset($_POST['op']) and $_POST['op'] == 'showDetails')
	{
		$orderId = $_POST['orderId'];

		$order = $orderBS->getOrders($orderId);

		echo createOrderDetails($order[0]);
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'payOrder') 
	{
		$orderId = $_POST['orderId'];
	}
	elseif (isset($_POST['op']) and $_POST['op'] == 'addCustomer') 
	{
		$orderId = $_POST['orderId'];
		$customerId = $_POST['customerId'];
	}
	else
	{
		include 'orders.html.php';
		exit();
	}

	function createOrderDetails($order)
	{
		$orderTotal = 0;
		$orderDetailsHtml = '';

		if(isset($order->customer))
		{
			$orderDetailsHtml .= '<span>
									Customer:' . $order->customer->name . '
								</span>';
		}
		else
		{
			$orderDetailsHtml = '<label for="customer">
									<input type="text" name="customer" class="customerNumber"/>
									<input type="button" name="Add" onClick="addCustomer(' . $order->id . ');" />
								</label>';
		}

		$orderDetailsHtml .= '<span>
								Start Time: ' . $order->date . '
							</span>

							<table>
								<thead>
									<tr>
										<th>
											Product
										</th>
										<th>
											Chair #
										</th>
										<th>
											Price
										</th>
										<th>
											Quantity
										</th>
										<th>
											Total
										</th>
									</tr>
								</thead>
								<tbody>';

		foreach($order->orderDetails as $orderDetail)
		{
			$orderDetailsHtml .= '<tr>
									<td>
										 ' . $orderDetail->product->name . ' 
									</td>
									<td>
										 ' . $orderDetail->chair . ' 
									</td>
									<td>
										 ' . $orderDetail->priceEach . ' 
									</td>
									<td>
										 ' . $orderDetail->quantityOrdered . ' 
									</td>
									<td>
										 $ ' . $orderDetail->priceEach *  $orderDetail->quantityOrdered . ' 
									</td>
								 </tr>';

			$orderTotal += $orderDetail->priceEach *  $orderDetail->quantityOrdered;
		}



		$orderDetailsHtml .= ' </tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>Total</td>
										<td>
										  $ ' . $orderTotal . '
										</td>			
									</tr>
								</tfoot>
							</table>

							<input type="button" value="Pay" />';
	}

	