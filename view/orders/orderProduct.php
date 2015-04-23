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
		$productsListHtml="";
	     
		foreach ($productsList as $product)
		{
			$productsListHtml.= "<input class='productId css-checkbox' id='".$product->id ."' type='radio' name='productId' value='".$product->id . "'> </input> <label for='".$product->id ."' class='css-label'>".$product->name."</label><br />";
		}

				$productsListHtml.="<input class='productQuantity inputContent' type='text' name='productQuanti.$product->name.ty' placeholder='Quantity' value=''> ".
		"<input class='chair inputContent' type='text' name='chair' placeholder='Chair Number' value=''> ".
	    "<input type='button' onClick='addProducts(" . $orderId . ")' class='submitButton waves-effect waves-light btn green' value='Confirm'>";//</form>";
	

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
		
		$ret = $this->orderBS->addOrderDetail($orderDetail);

		if(is_array($ret))
		{
			header($ret['errorCode']);
	        header('Content-Type: application/json; charset=UTF-8');
	        die(json_encode($ret));
    	}
    	else
    	{
    		die('');
    	}
	}
}
