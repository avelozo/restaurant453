<?php

	include_once DIR_BASE . "dataaccess/productDA.php";
	include_once DIR_BASE . "model/model.product.php";
	include_once DIR_BASE . "mapper/restaurantMapper.php";

	class ProductMapper
	{
		private $productDAO;
		private $restaurantMapper;

		function ProductMapper()
		{
			$this->productDAO = new ProductDA();
			$this->restaurantMapper = new RestaurantMapper();
		}

		public function getProducts($restaurantId = null, $id = null, $group = true)
		{
			$productRet = [];

			$products = $this->productDAO->getProducts($restaurantId, $id, $group);

			foreach ($products as $product)
			{
				array_push($productRet, $this->createProduct($product));
			}

			return $productRet;
		}

		public function addProduct($product)
		{
			$this->productDAO->addProduct($product);
		}

		public function addProductStock($product)
		{
			$this->productDAO->addProductStock($product);
		}

		public function updateProduct($product)
		{
			$this->productDAO->updateProduct($product);
		}

		public function updateProductStock($product)
		{
			$this->productDAO->updateProductStock($product);
		}

		public function deleteProduct($productId)
		{
			$this->productDAO->deleteProduct($productId);
		}

		private function createProduct($product)
		{
			$prod = new Product();

			$prod->id = $product['productId'];
			$prod->name = $product['productName'];
			$prod->vendor = $product['productVendor'];
			$prod->description = $product['productDescription'];
			$prod->buyPrice = $product['stockProductBuyPrice'];
			$prod->price = $product['stockProductPrice'];
			$prod->restaurant = $this->restaurantMapper->createRestaurant($product);
			$prod->quantityInStock = $product['stockQuantity'];
			$prod->saleTaxRate = $product['stockSaleTaxRate'];

			return $prod;
		}
	}