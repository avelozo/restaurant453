<?php 

	include_once DIR_BASE . "dataaccess/db.inc.php";

	class CustomerDA extends BaseDB
	{
		private $conn;

		function CustomerDA()
		{
			$this->conn = parent::connectDatabase();
		}

		public function getCustomers($id = null, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'SELECT * 
				  		FROM `customer`';
				if($id != null)
					$sql .= " WHERE customerId = :id";

			    $prep = $connection->prepare($sql);
			    
			    if($id != null)
		    		$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching customer: ' . $e->getMessage();
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
						WHERE customerId = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
			    return $prep->fetchAll()[0]['Quantity'];
			}
			catch (PDOException $e)
			{
			    $error = 'Error counting orders by customers: ' . $e->getMessage();
			    die($error);
			    exit();
			}
		}

		public function addCustomer($customer, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				 $sql = 'INSERT INTO `customer` SET
			        customerName = :cname,
			        customerPhone = :cphone,
			        customerAddressLine1 = :caddr1,
			        customerAddressLine2 = :caddr2,
			        customerCity = :ccity,
			        customerState = :cstate,
			        customerCountry = :ccountry,
			        customerPostalCode = :cpostalCode';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':cname', $customer->name);
			    $prep->bindValue(':cphone', $customer->phone);
			    $prep->bindValue(':caddr1', $customer->addressLine1);
				$prep->bindValue(':caddr2', $customer->addressLine2);
			    $prep->bindValue(':ccity', $customer->city);
			    $prep->bindValue(':cstate', $customer->state);
			    $prep->bindValue(':ccountry', $customer->country);
				$prep->bindValue(':cpostalCode', $customer->postalCode);

			    $prep->execute();

			    $customer->id = $connection->lastInsertId();
				
				return '';
		    }
			catch (PDOException $e)
			{
				return 'Error inserting customer: ' . $e->getMessage() ;
			}
		}

		public function updateCustomer($customer, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				 $sql = 'UPDATE `customer` SET
			        customerName = :cname,
			        customerPhone = :cphone,
			        customerAddressLine1 = :caddr1,
			        customerAddressLine2 = :caddr2,
			        customerCity = :ccity,
			        customerState = :cstate,
			        customerCountry = :ccountry,
			        customerPostalCode = :cpostalCode 
			        WHERE customerId = :id';

			    $prep = $connection->prepare($sql);
			    $prep->bindValue(':cname', $customer->name);
			    $prep->bindValue(':cphone', $customer->phone);
			    $prep->bindValue(':caddr1', $customer->addressLine1);
				$prep->bindValue(':caddr2', $customer->addressLine2);
			    $prep->bindValue(':ccity', $customer->city);
			    $prep->bindValue(':cstate', $customer->state);
			    $prep->bindValue(':ccountry', $customer->country);
				$prep->bindValue(':cpostalCode', $customer->postalCode);
				$prep->bindValue(':id', $customer->id);

			    $prep->execute();
				
				return '';
		    }
			catch (PDOException $e)
			{
				return 'Error updating customer: ' . $e->getMessage();
			}
		}

		public function deleteCustomer($id, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
			  	$sql = 'DELETE FROM customer
						WHERE customerId = :id';

				$prep = $connection->prepare($sql);

				$prep->bindValue(':id', $id);

			    $prep->execute();
				
			    return '';
			}
			catch (PDOException $e)
			{
			    return 'Error deleting customer: ' . $e->getMessage();
			}	
		}

	}