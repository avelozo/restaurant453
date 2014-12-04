<?php

class OrderProduct
{

	public $productBS;
	public $orderBS;

	function OrderProduct($busOrder=null, $busProduct = null)
	{

		$this->orderBS = $busOrder;
		$this->productBS = $busProduct;
		
	}

	public function showProducts()
	{

		$orderId = $_POST['orderId'];
		$order = $this->orderBS->getOrders($orderId);

		$productsListHtml="";
		$productsList = $this->productBS->getProducts($order[0]->restaurant->id);
		//$productsListHtml="<form  action='?'' method='post' name='formOrderProduct'>";
	     
		foreach ($productsList as $product)
		{
			$productsListHtml.= "<input class='productId' type='radio' name='productId' value='".$product->id . "'> " .$product->name."</input> <br />";
		}

		$productsListHtml.="<input class='productQuantity' type='text' name='productQuantity' placeholder='Quantity' value=''> ".
		"<input class='chair' type='text' name='chair' placeholder='Chair Number' value=''> ".
	    "<input type='button' onClick='addProducts(" . $orderId . ")' class='submitButton' value='Confirm'>";//</form>";
	

		echo $productsListHtml;
	}


	public function addProducts()
	{
		$orderId = $_POST['orderId'];
		$productQuantity = $_POST['productQuantity'];
		$chair = $_POST['chair'];
		$productId = $_POST['productId']; 

		$order = $this->orderBS->getOrders($orderId)[0];
		$product = $this->productBS->getProducts(null, $productId)[0];

		$orderDetail = new OrderDetail($order,
									   $product,
									   $productQuantity,
									   $product->price,
									   $chair);
		
		$this->orderBS->addOrderDetail($orderDetail);

		//$productQuantity= $_POST['productQuantity'];
		//$productID= $_POST['productId']; 
		//$orderId= $_POST['orderId'];
		//$order = $this->orderBS->getOrders($orderId);
		//$orderDetail->product->id=
		//$order->orderDetails->quantityOrdered = $productQuantity;
	}
}
