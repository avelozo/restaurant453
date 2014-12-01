<?php 

	include_once DIR_BASE . "dataaccess/db.inc.php";

	class RestaurantDA extends BaseDB
	{
		private $conn;

		function RestaurantDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getRestaurants($id = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT * 
				  		FROM restaurant';
				if($id != null)
					$sql .= ' WHERE roleId = :id';

				$prep = $connection->prepare($sql);

			    if($id != null)
		    		$prep->bindValue(':id', $id);

				$prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching restaurant: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}

		public function countEmployees($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT COUNT(*) AS Quantity
				  		FROM employee
						WHERE restaurantId = :id';

				$prep = $connection->prepare($sql);

			    if($id != null)
		    		$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting employees by restaurant: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function countOrders($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT COUNT(*) AS Quantity
				  		FROM order
						WHERE restaurantId = :id';

				$prep = $connection->prepare($sql);

			    if($id != null)
		    		$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting orders by restaurant: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function countStocks($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT COUNT(*) AS Quantity
				  		FROM stock
						WHERE restaurantId = :id';

				$prep = $connection->prepare($sql);

			    if($id != null)
		    		$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting stocks by restaurant: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function addRestaurant($restaurant, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'INSERT INTO `restaurant`
						(`restaurantName`,
						`restaurantPhone`,
						`restaurantAddressLine1`,
						`restaurantAddressLine2`,
						`restaurantCity`,
						`restaurantState`,
						`restaurantCountry`,
						`restaurantPostalCode`)
						VALUES
						(:restaurantName,
						:restaurantPhone,
						:restaurantAddressLine1,
						:restaurantAddressLine2,
						:restaurantCity,
						:restaurantState,
						:restaurantCountry,
						:restaurantPostalCode)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':restaurantName', $restaurant->name);
			    $prep->bindValue(':restaurantPhone', $restaurant->phone);
			    $prep->bindValue(':restaurantAddressLine1', $restaurant->addressLine1);
			    $prep->bindValue(':restaurantAddressLine2', $restaurant->addressLine2);
			    $prep->bindValue(':restaurantCity', $restaurant->city);
			    $prep->bindValue(':restaurantState', $restaurant->state);
			    $prep->bindValue(':restaurantCountry', $restaurant->country);
			    $prep->bindValue(':restaurantPostalCode', $restaurant->postalCode);
			   
			    $prep->execute();

			    $restaurant->id = $connection->lastInsertId();

			    return '';
		    }
			catch (PDOException $e)
			{
				return 'Error inserting restaurant: ' . $e->getMessage();
			}
		}

		public function updateRestaurant($restaurant, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `restaurant` SET
						`restaurantName` = :restaurantName,
						`restaurantPhone` = :restaurantPhone,
						`restaurantAddressLine1` = :restaurantAddressLine1,
						`restaurantAddressLine2` = :restaurantAddressLine2,
						`restaurantCity` = :restaurantCity,
						`restaurantState` = :restaurantState,
						`restaurantCountry` = :restaurantCountry,
						`restaurantPostalCode` = :restaurantPostalCode
						WHERE
						`restaurant`.`restaurantId` = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':restaurantName', $restaurant->name);
			    $prep->bindValue(':restaurantPhone', $restaurant->phone);
			    $prep->bindValue(':restaurantAddressLine1', $restaurant->addressLine1);
			    $prep->bindValue(':restaurantAddressLine2', $restaurant->addressLine2);
			    $prep->bindValue(':restaurantCity', $restaurant->city);
			    $prep->bindValue(':restaurantState', $restaurant->state);
			    $prep->bindValue(':restaurantCountry', $restaurant->country);
			    $prep->bindValue(':restaurantPostalCode', $restaurant->postalCode);
			    $prep->bindValue(':id', $restaurant->id);
			   
			    $prep->execute();

			    return '';
		    }
			catch (PDOException $e)
			{
				return 'Error updating restaurant: ' . $e->getMessage();
			}
		}

		public function deleteRestaurant($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'DELETE FROM restaurant
						WHERE restaurantId = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
				
			    return '';
			}
			catch (PDOException $e)
			{
			    return 'Error deleting restaurant: ' . $e->getMessage();
			}	
		}

	}