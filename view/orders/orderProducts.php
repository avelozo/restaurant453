<?php
class productList
{

	private $productBS;
	private $restaurantBS;

	function ProductList($busProduct = null, $busRestaurant = null)
	{
		$this->productBS = $busProduct;
		$this->$restaurantBS = $busRestaurant;
	}

	public function showProducts()
	{
		$productsListHtml="";
		$productsList = $productBS->getProducts($restaurantBS->id);

		foreach ($products as $product)
		{
			$productsListHtml.= "<button type='button'>".$product->name."</button>";
		}

		return $productsListHtml;
	}


	
}
