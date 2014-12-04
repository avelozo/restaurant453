<?php 

	include_once DIR_BASE . "dataaccess/db.inc.php";

	class EmployeeDA extends BaseDB
	{
		private $conn;

		function EmployeeDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getEmployees($id = null, $userName = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'SELECT
							emp.*,
							sup.`employeeId` AS supervisorId,
							sup.`employeeSSN` AS supervisorSSN,
						    sup.`employeeLastName` AS supervisorLastName,
						    sup.`employeeFirstName` AS supervisorFirstName,
						    sup.`employeeEmail` AS supervisorEmail,
						    sup.`restaurantId` AS supervisorRestaurantId,
						    sup.`employeeReportsTo` AS supervisorReportsTo,
						    sup.`employeeJobTitle` AS supervisorJobTitle,
						    sup.`employeeUserName` AS supervisorUserName,
						    sup.`employeePassword` AS supervisorPassword,
						    sup.`roleId` AS supervisorRoleId,
							`role`.*,
							`restaurant`.*
						FROM
							`employee` emp
							LEFT JOIN
							`employee` sup
							ON emp.employeeReportsTo = sup.employeeId
							LEFT JOIN
							`restaurant`
							ON emp.restaurantId = `restaurant`.restaurantId
							LEFT JOIN
							`role`
							ON emp.roleId = `role`.roleId';

				if($id != null)
			    {
		    		$sql .= ' WHERE emp.employeeId = :id';
				}
				elseif($userName != null)
				{
					$sql .= ' WHERE emp.employeeUserName = :userName';	
				}

				$prep = $connection->prepare($sql);
			    
			    if($id != null)
			    {
		    		$prep->bindValue(':id', $id);
		    	}
		    	elseif($userName != null)
				{
					$prep->bindValue(':userName', $userName);
				}

			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching employees: ' . $e->getMessage();
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
				  		FROM `employee`
						WHERE employeeReportsTo = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting employees by supervisor: ' . $e->getMessage();
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
				  		FROM `order`
						WHERE employeeId = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting orders by employee: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function addEmployee($employee, $connection=null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'INSERT INTO `employee`
						(`employeeSSN`,
						`employeeLastName`,
						`employeeFirstName`,
						`employeeEmail`,
						`restaurantId`,
						`employeeReportsTo`,
						`employeeJobTitle`,
						`employeeUserName`,
						`employeePassword`,
						`roleId`)
						VALUES
						(:employeeSSN,
						:employeeLastName,
						:employeeFirstName,
						:employeeEmail,
						:restaurantId,
						:employeeReportsTo,
						:employeeJobTitle,
						:employeeUserName,
						:employeePassword,
						:roleId)';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':employeeSSN', $employee->ssn);
			    $prep->bindValue(':employeeLastName', $employee->lastName);
			    $prep->bindValue(':employeeFirstName', $employee->firstName);
			    $prep->bindValue(':employeeEmail', $employee->email);
				$prep->bindValue(':restaurantId', $employee->restaurant->id);
				if ($employee->reportsTo == null)
					$prep->bindValue(':employeeReportsTo', null);
				else
					$prep->bindValue(':employeeReportsTo', $employee->reportsTo->id);
			   	$prep->bindValue(':employeeJobTitle', $employee->jobTitle);
			    $prep->bindValue(':employeeUserName', $employee->userName);
			    $prep->bindValue(':employeePassword', $employee->password);
				$prep->bindValue(':roleId', $employee->role->id);

			    $prep->execute();

			    $employee->id = $connection->lastInsertId();

			    return '';
		    }
			catch (PDOException $e)
			{
				die('Error inserting employee: ' . $employee->reportsTo . $e->getMessage());
			}
		}

		public function updateEmployee($employee, $connection= null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				$sql = 'UPDATE `employee`
						SET
						`employeeSSN` = :employeeSSN,
						`employeeLastName` = :employeeLastName,
						`employeeFirstName` = :employeeFirstName,
						`employeeEmail` = :employeeEmail,
						`restaurantId` = :restaurantId,
						`employeeReportsTo` = :employeeReportsTo,
						`employeeJobTitle` = :employeeJobTitle,
						`employeeUserName` = :employeeUserName,
						`employeePassword` = :employeePassword,
						`roleId` = :roleId
						WHERE `employeeId` = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':employeeSSN', $employee->ssn);
			    $prep->bindValue(':employeeLastName', $employee->lastName);
			    $prep->bindValue(':employeeFirstName', $employee->firstName);
			    $prep->bindValue(':employeeEmail', $employee->email);
				$prep->bindValue(':restaurantId', $employee->restaurant->id);
				if ($employee->reportsTo == null)
					$prep->bindValue(':employeeReportsTo', null);
				else
					$prep->bindValue(':employeeReportsTo', $employee->reportsTo->id);
			   	$prep->bindValue(':employeeJobTitle', $employee->jobTitle);
			    $prep->bindValue(':employeeUserName', $employee->userName);
			    $prep->bindValue(':employeePassword', $employee->password);
				$prep->bindValue(':roleId', $employee->role->id);
				$prep->bindValue(':id', $employee->id);

			    $prep->execute();

			    return '';
		    }
			catch (PDOException $e)
			{
				return 'Error updating employee: ' . $e->getMessage();
			}
		}

		public function deleteEmployee($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'DELETE FROM `employee`
						WHERE `employeeId` = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
				
			    return '';
			}
			catch (PDOException $e)
			{
			    return 'Error deleting employee: ' . $e->getMessage();
			}	
		}
	}