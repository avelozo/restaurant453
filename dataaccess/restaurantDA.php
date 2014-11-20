<?php 

	include_once "db.inc.php";

	class RestaurantDA extends BaseDB
	{
		private $conn;

		function RestaurantDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getRestaurants($connection = null)
		{
			
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
				  			* 
				  		  FROM 
				  		  	restaurant';
			    $prep = $connection->prepare($sql);
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

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting restaurant: ' . $e->getMessage();
				die($error);
				exit();
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

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting restaurant: ' . $e->getMessage();
				die($error);
				exit();
			}
		}
	}