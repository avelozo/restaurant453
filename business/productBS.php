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

		public function getProducts($restaurantId = null, $id = null, $group = true)
		{
			return $this->productMapper->getProducts($restaurantId, $id, $group);
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
		
		public function updateProductStock($product)
		{
			$this->productMapper->updateProductStock($product);
		}

		public function deleteProduct($id)
		{
			return $this->productMapper->deleteProduct($id);
		}
	}