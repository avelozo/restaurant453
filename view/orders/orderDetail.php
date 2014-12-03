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

		if(isset($order->customer->id))
		{
			$orderDetailsHtml .= '<p>
									Customer: ' . $order->customer->name . '
								</p>';
		}
		else
		{
			$orderDetailsHtml = '<p><label for="customer">
									<input type="text" name="customer" class="customerNumber" placeholder="Customer Number" />
									<input type="button" name="Add" value="Add" onClick="addCustomer(' . $order->id . ');" />
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
										<td></td>
										<td></td>
										<td></td>
										<td>Total</td>
										<td class="orderDetailsTableNumber">
										  $ ' . number_format($orderTotal, 2, '.', '') . '
										</td>			
									</tr>
								</tfoot>
							</table>

							<input type="button" value="Pay" onclick="payOrder(' . $order->id . ');"/>
							<input type="button" value="Add Product" onclick="chooseProduct(' . $order->id . ');" />';

		return $orderDetailsHtml;
	}
}