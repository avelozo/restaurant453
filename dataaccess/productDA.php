<?php 

	include_once "db.inc.php";

	class ProductDA extends BaseDB
	{
		private $conn;

		function ProductDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getProducts($restaurantId = null, $id = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
							*
						FROM 
							`product`
							INNER JOIN
							`stock`
							ON `product`.`productId` = `stock`.`productId`
							INNER JOIN
							`restaurant`
							ON `stock`.`restaurantId` = `restaurant`.`restaurantId`;';

				if($id != null)
				{
					$sql .= " WHERE `product`.`productId` = :id";
				}
				elseif ($restaurantId != null) 
				{
					$sql .= " WHERE `restaurant`.`restaurantId` = :restaurantId";
				}

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
				$connection->beginTransaction();

				$sql = 'INSERT INTO `product`
						(`productName`,
						`productVendor`,
						`productDescription`,
						`productBuyPrice`,
						`productPrice`)
						VALUES
						(:productName,
						:productVendor,
						:productDescription,
						:productBuyPrice,
						:productPrice)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productName', $product->name);
			    $prep->bindValue(':productVendor', $product->vendor);
			    $prep->bindValue(':productDescription', $product->description);
				$prep->bindValue(':productBuyPrice', $product->buyPrice);
			    $prep->bindValue(':productPrice', $product->price);
			   
			    $prep->execute();

			    $product->id = $connection->lastInsertId();

			    $this->addProductStock($product);

			    $connection->commit();

			    return true;
		    }
			catch (PDOException $e)
			{
				$connection->rollBack();

				$error = 'Error inserting product: ' . $e->getMessage();
				die($error);
				exit();
			}
		}

		public function addProductStock($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

		 	$sql = 'INSERT INTO `stock`
					(`productId`,
					`restaurantId`,
					`stockQuantity`)
					VALUES
					(:productId,
					:restaurantId,
					:stockQuantity)';

		    $prep = $connection->prepare($sql);
		    $prep->bindValue(':productId', $product->id);
		    $prep->bindValue(':restaurantId', $product->restaurant->id);
		    $prep->bindValue(':stockQuantity', $product->quantityInStock);
		   
		    $prep->execute();

		    return true;
		}

		public function updateProduct($product, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$connection->beginTransaction();

				$sql = 'UPDATE `product`
						SET
						`productName` = :productName,
						`productVendor` = :productVendor,
						`productDescription` = :productDescription,
						`productBuyPrice` = :productBuyPrice,
						`productPrice` = :productPrice
						WHERE `productId` = :productId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':productName', $product->name);
			    $prep->bindValue(':productVendor', $product->vendor);
			    $prep->bindValue(':productDescription', $product->description);
				$prep->bindValue(':productBuyPrice', $product->buyPrice);
			    $prep->bindValue(':productPrice', $product->price);
			    $prep->bindValue(':productId', $product->id);

			    $prep->execute();

			    $this->updateProductStock($product, $connection);

			    $connection->commit();

			    return true;
		    }
			catch (PDOException $e)
			{
				$connection->rollBack();
			    $error = 'Error updating customer: ' . $e->getMessage();
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
							`stockQuantity` = :stockQuantity
							WHERE 
							`productId` = :productId 
							AND `restaurantId` = :restaurantId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':stockQuantity', $product->quantityInStock);
			    $prep->bindValue(':restaurantId', $product->restaurant->id);
			    $prep->bindValue(':productId', $product->id);

			    $prep->execute();
		    }
			catch (PDOException $e)
			{
			  $error = 'Error updating customer: ' . $e->getMessage();
			  die($error);
			  exit();
			}
		}
	}