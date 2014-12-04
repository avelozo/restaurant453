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

		foreach ($productsList as $product)
		{
			$productsListHtml.= "<input type='radio' name='productName' value='".$product->id ."' checked>".$product->name."</button>";
		}

		return $productsListHtml;
	}


	public function addProducts(){
		$productQuantity= $POST["productQuantity"];
		$orderId = $_POST['orderId'];
		$order = $this->orderBS->getOrders($orderId);
		$order->orderDetails->quantityOrdered = $productQuantity;
	}

	
}
