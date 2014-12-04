<?php

	include_once DIR_BASE . "mapper/productMapper.php";
	include_once DIR_BASE . "model/model.product.php";

	class ProductBS
	{
		private $productMapper = null;

		function ProductBS()
		{
			$this->productMapper = new ProductMapper();
		}

		public function getProducts($restaurantId = null, $id = null, $group = true, $connection = null)
		{
			return $this->productMapper->getProducts($restaurantId, $id, $group, $connection);
		}

		public function addProduct($product)
		{
			$this->productMapper->addProduct($product);
		}

		public function addProductStock($product)
		{
			$productCheck = $this->productMapper->getProducts($product->restaurant->id, $product->id);
			if(count($productCheck) > 0)
			{
				$this->updateProductStock($product);
			}
			else
			{
				$this->productMapper->addProductStock($product);
			}
		}
		
		public function updateProduct($product)
		{
			$this->productMapper->updateProduct($product);
		}
		
		public function updateProductStock($product, $connection = null)
		{
			$this->productMapper->updateProductStock($product, $connection);
		}

		public function deleteProduct($id)
		{
			return $this->productMapper->deleteProduct($id);
		}
	}