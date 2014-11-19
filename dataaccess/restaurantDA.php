<?php 

	include_once "db.inc.php";

	class RestaurantDA extends BaseDB
	{
		public function getRestaurants()
		{
			
			$connection = parent::connectDatabase();

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