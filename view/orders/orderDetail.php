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
	}

	public function addCustomer()
	{
		$orderId = $_POST['orderId'];
		$customerId = $_POST['customerId'];
	}

	public function chooseProduct()
	{

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

							<input type="button" value="Pay" onclick="payOrder(' . $order->id . ');"/>
							<input type="button" value="Add Product" onclick="chooseProduct(' . $order->id . ');" />';

		return $orderDetailsHtml;
	}
}