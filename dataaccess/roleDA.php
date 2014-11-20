<?php 

	include_once DIR_BASE . "dataaccess/db.inc.php";

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

		public function addRole($role, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'INSERT INTO `role`
						(`roleName`)
						VALUES
						(:roleName)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':roleName', $role->name);
			   
			    $prep->execute();

			    $role->id = $connection->lastInsertId();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error inserting role: ' . $e->getMessage();
				die($error);
				exit();
			}
		}

		public function updateRole($role, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `role` SET
						`roleName` = :roleName
						WHERE `roleId` = :roleId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':roleName', $role->name);
			    $prep->bindValue(':roleId', $role->id);
			   
			    $prep->execute();

			    return true;
		    }
			catch (PDOException $e)
			{
				$error = 'Error updating role: ' . $e->getMessage();
				die($error);
				exit();
			}
		}
	}