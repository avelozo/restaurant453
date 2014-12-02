<?php 

	include_once "db.inc.php";

	class ProductDA extends BaseDB
	{
		private $conn;

		function ProductDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getProducts($restaurantId = null, $id = null, $group = true, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
							`vwproduct`.*,
							`stock`.`stockId`,
							`stock`.`stockQuantity`,
							`stock`.`stockSaleTaxRate`,
							`stock`.`stockProductBuyPrice`,
							`stock`.`stockProductPrice`,
							`vwrestaurant`.*
						FROM 
							`vwproduct`
							LEFT JOIN
							`stock`
							ON `vwproduct`.`productId` = `stock`.`productId`
							LEFT JOIN
							`vwrestaurant`
							ON `stock`.`restaurantId` = `vwrestaurant`.`restaurantId`';

				if($id != null)
				{
					$sql .= ' WHERE `vwproduct`.`productId` = :id ';
				}
				elseif ($restaurantId != null) 
				{
					$sql .= ' WHERE `vwrestaurant`.`restaurantId` = :restaurantId ';
				}

				if($group)
					$sql .= ' GROUP BY
	 							`vwproduct`.`productId` ';


			    $prep = $connection->prepare($sql);
			    
			    if($id != null)
			    {
		    		$prep->bindValue(':id', $id);
		    	}
		    	elseif ($restaurantId != null) 
		    	{
		    		$prep->bindValue(':restaurantId', $restaurantId);
		    	}

			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching product: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}

		public function addProduct($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'INSERT INTO `product`
						(`productName`,
						`productVendor`,
						`productDescription`)
						VALUES
						(:productName,
						:productVendor,
						:productDescription)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productName', $product->name);
			    $prep->bindValue(':productVendor', $product->vendor);
			    $prep->bindValue(':productDescription', $product->description);
				
			   
			    $prep->execute();

			    $product->id = $connection->lastInsertId();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}

		public function addProductStock($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			 	$sql = 'INSERT INTO `stock`
						(`productId`,
						`restaurantId`,
						`stockQuantity`,
						`stockSaleTaxRate`,
						`stockProductBuyPrice`,
						`stockProductPrice`)
						VALUES
						(:productId,
						:restaurantId,
						:stockQuantity,
						:stockSaleTaxRate,
						:productBuyPrice,
						:productPrice)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productId', $product->id);
			    $prep->bindValue(':restaurantId', $product->restaurant->id);
			    $prep->bindValue(':stockQuantity', $product->quantityInStock);
			    $prep->bindValue(':stockSaleTaxRate', $product->saleTaxRate);
			    $prep->bindValue(':productBuyPrice', $product->buyPrice);
				$prep->bindValue(':productPrice', $product->price);
			   
			    $prep->execute();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting product stock: ' . $e->getMessage();
				die($error);
				exit();
			}
		}

		public function updateProduct($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `product`
						SET
						`productName` = :productName,
						`productVendor` = :productVendor,
						`productDescription` = :productDescription
						WHERE `productId` = :productId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productName', $product->name);
			    $prep->bindValue(':productVendor', $product->vendor);
			    $prep->bindValue(':productDescription', $product->description);
			    $prep->bindValue(':productId', $product->id);

			    $prep->execute();

			    return true;
		    }
			catch (PDOException $e)
			{
			    $error = 'Error updating product: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function updateProductStock($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `stock`
							SET
							`stockQuantity` = `stockQuantity` + :stockQuantity,
							`stockProductBuyPrice` = :productBuyPrice,
							`stockProductPrice` = :productPrice
							WHERE 
							`productId` = :productId 
							AND `restaurantId` = :restaurantId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':stockQuantity', $product->quantityInStock);
			    $prep->bindValue(':restaurantId', $product->restaurant->id);
			    $prep->bindValue(':productId', $product->id);
			    $prep->bindValue(':productBuyPrice', $product->buyPrice);
			    $prep->bindValue(':productPrice', $product->price);

			    $prep->execute();
		    }
			catch (PDOException $e)
			{
			  $error = 'Error updating stock: ' . $e->getMessage();
			  die($error);
			  exit();
			}
		}

		public function deleteProduct($productId, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `product`
						SET
						`productDeleted` = :productDeleted
						WHERE `productId` = :productId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productId', $productId);
			    $prep->bindValue(':productDeleted', 1);

			    $prep->execute();

			    return true;
		    }
			catch (PDOException $e)
			{
			    $error = 'Error deleting product: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}
	}