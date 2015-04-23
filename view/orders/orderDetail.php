<?php

class OrderDetailView
{
	private $orderBS;

	function OrderDetailView($business)
	{
		$this->orderBS = $business;
	}

	public function showDetails()
	{
		$orderId = $_POST['orderId'];

		$order = $this->orderBS->getOrders($orderId);

		echo $this->createOrderDetails($order[0]);
	}

	public function payOrder()
	{
		$orderId = $_POST['orderId'];

		$this->orderBS->payOrder($orderId);

		exit();
	}

	public function addCustomer()
	{
		$orderId = $_POST['orderId'];
		$customerId = $_POST['customerId'];

		$ret = $this->orderBS->addCustomer($orderId, $customerId);

		if(is_array($ret))
		{
			header($ret['errorCode']);
	        header('Content-Type: application/json; charset=UTF-8');
	        die(json_encode($ret));
    	}
    	else
    	{
    		echo $this->createOrderDetails($ret);
    	}
	}

	public function chooseProduct()
	{

	}

	function createOrderDetails($order)
	{
		$orderTotal = 0;
		$orderDetailsHtml = '';

		$orderDetailsHtml .= '<p>
									<h4>Table Number: ' . $order->tableNumber . '
								</h4></p>';

		if(isset($order->customer->name))
		{
			$orderDetailsHtml .= '<p>
									<h5>Customer: ' . $order->customer->name . '
								</h5></p>';
		}
		else
		{
			$orderDetailsHtml .= '';
		}

		$orderDetailsHtml .= '<p><h5>
								Start Time: ' . date('m/d/Y H:i', strtotime($order->date)) . '
							</h5></p>
							<table class="bordered hoverable responsive-table">
								<thead>
									<tr>
										<th data-field="id" class="center-align">
											Product
										</th>
										<th data-field="id" class="center-align">
											Chair #
										</th>
										<th data-field="id" class="center-align">
											Price
										</th>
										<th data-field="id" class="center-align">
											Quantity
										</th>
										<th data-field="id" class="center-align">
											Total
										</th>
									</tr>
								</thead>
								<tbody>';

		foreach($order->orderDetails as $orderDetail)
		{
			$orderDetailsHtml .= '<tr>
									<td class="center-align">
										 ' . $orderDetail->product->name . ' 
									</td>
									<td class="center-align">
										 ' . $orderDetail->chair . ' 
									</td>
									<td class="center-align">
										$ ' . number_format($orderDetail->priceEach, 2, '.', '') . ' 
									</td>
									<td class="center-align">
										 ' . $orderDetail->quantityOrdered . ' 
									</td>
									<td class="center-align">
										 $ ' . number_format($orderDetail->priceEach *  $orderDetail->quantityOrdered, 2, '.', '')  . ' 
									</td>
								 </tr>';

			$orderTotal += $orderDetail->priceEach *  $orderDetail->quantityOrdered;
		}



		$orderDetailsHtml .= ' </tbody>
								<tfoot>
									<tr>
										<td class="center-align"></td>
										<td class="center-align"></td>
										<td class="center-align"></td>
										<td class="center-align">Total</td>
										<td class="center-align">
										  $ ' . number_format($orderTotal, 2, '.', '') . '
										</td>			
									</tr>
								</tfoot>
							</table>

							<a class="waves-effect waves-light btn " onclick="payOrder(' . $order->id . ');" >Pay<i class="mdi-editor-attach-money right-align"></i></a>

<a class="waves-effect waves-light btn modal-trigger" onclick="chooseProduct(' . $order->id . ');" href="#modal1">Add Product<i class="mdi-maps-local-pizza right-align"></i></a>
<script type="text/javascript"> $(document).ready(function(){
      $(".modal-trigger").leanModal()
       });</script>';
		return $orderDetailsHtml;
	}
}