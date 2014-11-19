<?php 

	include_once "db.inc.php";

	class RoleDA extends BaseDB
	{
		private $conn;

		function RoleDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getRoles($connection = null)
		{
			
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT 
				  			* 
				  		  FROM 
				  		  	role';
			    $prep = $connection->prepare($sql);
			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching role: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}
	}