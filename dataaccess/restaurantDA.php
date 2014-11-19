<?php 

	include_once "db.inc.php";

	public class RestaurantDA extends BaseDB
	{
		private $conn;

		public RestaurantDA()
		{
			$conn = parent::connectDatabase();
		}

		public getRestaurants($connection)
		{
			if(!isset($connection))
				$connection = $conn;

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