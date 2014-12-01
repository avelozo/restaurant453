<?php 

	include_once DIR_BASE . "dataaccess/db.inc.php";

	class RoleDA extends BaseDB
	{
		private $conn;

		function RoleDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getRoles($id = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT * 
				  		FROM role';
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
			    $error = 'Error fetching role: ' . $e->getMessage();
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
						WHERE roleId = :id';

				$prep = $connection->prepare($sql);

			    if($id != null)
		    		$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting employees by role: ' . $e->getMessage();
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

			    return '';
		    }
			catch (PDOException $e)
			{
				return 'Error inserting role: ' . $e->getMessage();
			}
		}

		public function updateRole($role, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `role`
						SET `roleName` = :roleName
						WHERE `roleId` = :roleId';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':roleName', $role->name);
			    $prep->bindValue(':roleId', $role->id);
			   
			    $prep->execute();

			    return '';
		    }
			catch (PDOException $e)
			{
				return 'Error updating role: ' . $e->getMessage();
			}
		}

		public function deleteRole($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'DELETE FROM role
						WHERE roleId = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
				
			    return '';
			}
			catch (PDOException $e)
			{
			    return 'Error deleting role: ' . $e->getMessage();
			}	
		}
		
	}