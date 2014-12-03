<?php
class productList
{

	private $productBS;
	private $orderBS;

	function ProductList($busOrder=null, $busProduct = null)
	{
		$this->$orderBS = $busOrder;
		$this->productBS = $busProduct;
		
	}

	public function showProducts()
	{
		$productsListHtml="";
		$productsList = $productBS->getProducts($orderBS->restaurant->id);

		foreach ($products as $product)
		{
			$productsListHtml.= "<button type='button'>".$product->name."</button>";
		}

		return $productsListHtml;
	}


	
}
