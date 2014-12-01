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

		public function addProduct($role)
		{
			$this->productMapper->addProduct($role);
		}
		
		public function updateProduct($role)
		{
			$this->productMapper->updateProduct($role);
		}
		
		public function deleteProduct($id)
		{
			return $this->productMapper->deleteProduct($id);
		}
	}