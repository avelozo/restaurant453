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

		$orderId =1;// $_POST['orderId'];
		$order = $this->orderBS->getOrders($orderId);

		$productsListHtml="";
		$productsList = $this->productBS->getProducts($order[0]->restaurant->id);
		$productsListHtml="<form  action='?'' method='post' name='formOrderProduct'>";
	     
		foreach ($productsList as $product)
		{
			$productsListHtml.= "<input type='radio' name='productId' value='".$product->id ."'>".$product->name."</button>";
		}

		$productsListHtml.="<input type='text' name='productQuantity' value='<?php $productQuantity ?>'> ".
	    "<input type='submit' class='submitButton' value='Confirm'></form>";
	

		echo $productsListHtml;
	}


	public function addProducts(){
		$productQuantity= $_POST['productQuantity'];
		$productID= $_POST['productId']; 
		$orderId= $_POST['orderId'];
		$order = $this->orderBS->getOrders($orderId);
		//$orderDetail->product->id=
		//$order->orderDetails->quantityOrdered = $productQuantity;
	}
}
