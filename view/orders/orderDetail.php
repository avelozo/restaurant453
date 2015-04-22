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
									Table Number: ' . $order->tableNumber . '
								</p>';

		if(isset($order->customer->name))
		{
			$orderDetailsHtml .= '<p>
									Customer: ' . $order->customer->name . '
								</p>';
		}
		else
		{
			$orderDetailsHtml .= '<p><label for="customer">
									<input type="text" name="customer" class="inputContent customerNumber" placeholder="Customer Number" />
									<input type="button" class="submitButton" name="Add" value="Add" onClick="addCustomer(' . $order->id . ');" />
								</label></p>';
		}

		$orderDetailsHtml .= '<p>
								Start Time: ' . date('m/d/Y H:i', strtotime($order->date)) . '
							</p>
							<table class="orderDetailsTable">
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
									<td class="orderDetailsTableNumber">
										$ ' . number_format($orderDetail->priceEach, 2, '.', '') . ' 
									</td>
									<td class="orderDetailsTableNumber">
										 ' . $orderDetail->quantityOrdered . ' 
									</td>
									<td class="orderDetailsTableNumber">
										 $ ' . number_format($orderDetail->priceEach *  $orderDetail->quantityOrdered, 2, '.', '')  . ' 
									</td>
								 </tr>';

			$orderTotal += $orderDetail->priceEach *  $orderDetail->quantityOrdered;
		}



		$orderDetailsHtml .= ' </tbody>
								<tfoot>
									<tr>
										<td class="totalOrder"></td>
										<td class="totalOrder"></td>
										<td class="totalOrder"></td>
										<td class="totalOrder">Total</td>
										<td class="orderDetailsTableNumber totalOrder">
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