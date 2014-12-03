<?php

class ProductList
{

	public $productBS;
	public $orderBS;

	function ProductList($busOrder=null, $busProduct = null)
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
		$productQuantity= $POST["productQuantity"]
		$this->order->orderDetails->quantityOrdered = $productQuantity;
	}

	
}
