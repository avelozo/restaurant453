<?php 

	include_once "db.inc.php";

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
			  	$sql = 'SELECT 
				  			* 
				  		  FROM 
				  		  	`customer`';
				if($id != null)
					$sql .= " WHERE customerId = :id";

			    $prep = $connection->prepare($sql);
			    
			    if($id != null)
		    		$prep->bindValue(':customerId', $id);

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

		public function addCustomer($customer, $connection = null)
		{
			if($connection == null)
				$connection = $this->conn;

			try
			{
				 $sql = 'INSERT INTO `customer` SET
			        customerName = :cname,
			        phone = :cphone,
			        addressLine1 = :caddr1,
			        addressLine2 = :caddr2,
			        city = :ccity,
			        state = :cstate,
			        country = :ccountry,
			        postalCode = :cpostalCode';

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
		    }
			catch (PDOException $e)
			{
			  $error = 'Error inserting customer: ' . $e->getMessage();
			  die($error);
			  exit();
			}
		}
	}