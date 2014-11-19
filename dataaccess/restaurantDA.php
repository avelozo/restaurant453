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
	}