<?php

	include_once "dataaccess/productDA.php";
	include_once "model/model.product.php";
	include_once "restaurantMapper.php";

	class ProductMapper
	{
		private $productDAO;
		private $restaurantMapper;

		function ProductMapper()
		{
			$this->productDAO = new ProductDA();
			$this->restaurantMapper = new RestaurantMapper();
		}

		public function getProducts($restaurantId = null, $id = null)
		{
			$productRet = [];

			$products = $this->productDAO->getProducts($restaurantId, $id);

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

		private function createProduct($product)
		{
			$prod = new Product();

			$prod->id = $product['productId'];
			$prod->name = $product['productName'];
			$prod->vendor = $product['productVendor'];
			$prod->description = $product['productDescription'];
			$prod->buyPrice = $product['productBuyPrice'];
			$prod->price = $product['productPrice'];
			$prod->restaurant = $this->restaurantMapper->createRestaurant($product);
			$prod->quantityInStock = $product['stockQuantity'];

			return $prod;
		}
	}